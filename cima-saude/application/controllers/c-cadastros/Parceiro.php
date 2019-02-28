<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Parceiro extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('parse');
		}

		//Método que carrega a view principal com a tabela e a leitura dos registros
		public function index(){
			//Verifica sessão
			if($this->session->userdata('is_logged_in') != 1){
				$this->logout();
				redirect('acesso/login');
			}
			//---------------
			$this->load->view('commons/sidebar');
			$table = "parceiros";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('cadastros/parceiros/parceiros-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$table = "especialidades";
			$data['dataEspecialidades'] = $this->Generic_model->readAll($table);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/parceiros/parceiros-create", $data);
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());	die;
			$data = parseParceiro($this->input->post(), $this->session->userdata('id'));
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			
			//Insersão do parceiro
			$resultado = $this->Generic_model->insert($table, $campoId, $data);
			//var_dump($resultado['cod_parceiro']); die;

			//Inserindo as especialidades Médicas
			//Insere até 4 especialidades onde o valor da especialidade enviada por post deve ser diferente de ""
			for($i = 0; $i < 4; $i++){
				if($this->input->post('especialidade'.($i+1)) != ''){
					$especialidade = array(
						'fk_especialidade' => $this->input->post('especialidade'.($i+1)),
						'fk_parceiro' => $resultado['cod_parceiro']
					);
					$r = $this->Generic_model->insert("especialidades_parceiros", "cod_especialidade_parceiro", $especialidade);
				}
			}
			
			if($this->input->post('imprimir') == 1){
				$this->session->set_flashdata('imprimir', $resultado['cod_parceiro']);
			}
			if($this->input->post('enviarEmail') == 1){
				$this->enviarEmail($resultado['cod_parceiro'], $this->input->post('destino'), $this->input->post('msg'));
			}


			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Parceiro salvo com sucesso!');	
					redirect('parceiros');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('parceiros');
			}
	      	
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$table = 'especialidades_parceiros';
			$campoId = 'fk_parceiro';
			$id = $cod;
			
			$resultado['codEspecialidades'] = $this->Generic_model->readAllWhere($table, $campoId, $id); //var_dump($resultado['codEspecialidades']); die;

			for($i = 0; $i < 4; $i++){
				if(isset($resultado['codEspecialidades'][$i])){
					$resultado['especialidade'][$i] = $resultado['codEspecialidades'][$i]['fk_especialidade'];
				}
				else{
					$resultado['especialidade'][$i]='';
				}
			}

			//var_dump($resultado['especialidade']); die;
			$table = "especialidades";
			$resultado['dataEspecialidades'] = $this->Generic_model->readAll($table);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/parceiros/parceiros-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			//var_dump($this->input->post()); die;
			$data = parseParceiro($this->input->post(), $this->session->userdata('id'));
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $this->input->post('cod_parceiro');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			

			$resultado = $this->Generic_model->delete('especialidades_parceiros', 'fk_parceiro', $id);

			for($i = 0; $i < 4; $i++){
				if($this->input->post('especialidade'.($i+1)) != ''){
					$especialidade = array(
						'fk_especialidade' => $this->input->post('especialidade'.($i+1)),
						'fk_parceiro' => $id
					);

					$r = $this->Generic_model->insert("especialidades_parceiros", "cod_especialidade_parceiro", $especialidade);
				}
			}

			if($resultado){
					
				$this->session->set_flashdata('msg', 'Parceiro alterado com sucesso!');	
				redirect('parceiros');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
				redirect('parceiros');
			}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			//var_dump($this->input->post()); die;
			$data = $this->input->post('cod_parceiro');
			$table = 'parceiros';
			$campoId = 'cod_parceiro';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
					
				$this->session->set_flashdata('msg', 'Parceiro excluído com sucesso!');	
				redirect('parceiros');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
				redirect('parceiros');
			}
		}










		public function enviarEmail($cod){
			//Criando o PDF da proposta

			$data['parceiro'] = $this->Generic_model->readById('parceiros', 'cod_parceiro', $cod);

			$data['especialidades']= $this->Generic_model->readAllWhere('especialidades_parceiros', 'fk_parceiro', $cod);

		
			for($i = 0; $i < count($data['especialidades']); $i++){
				$r = $this->Generic_model->readById('especialidades', 'cod_especialidade', $data['especialidades']['fk_especialidade']);
				$data['nomesEspecialidades'][$i] = $r['nome'];
			}


			
				$mpdf = new mPDF();
				$html = $this->load->view('contratos/contrato-template/template-parceiro', $data, TRUE);
				$mpdf->AddPage('','','','','');
				
				$mpdf->SetHeader('CIMA SAÚDE');
				
				$mpdf->SetFooter('
					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none; border-collapse:collapse;"> 
					<tr style="border: none;">

						<td width="50%" style="border: none;"><span style="font-weight: bold; font-style: italic;">www.cimasaude.com.br</span></td>

						<td width="50%" style="text-align: right; border: none;">{PAGENO}</td>

						</tr>
					</table>
					');
				$mpdf->writeHTML($html);
				
				$mpdf->Output('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Proposta-'. $data['proposta']['numero'] .'.pdf' , 'F');
				


			//Enviando o PDF da proposta por email

	        $this->load->library('email');
	         
	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
	        $config['mailtype'] = 'html';
	        
	        $this->email->initialize($config);
	        
	        // Define remetente e destinatário
	        $this->email->from('noreply@cimasaude.com', 'Remetente'); // Remetente
	        $this->email->to($data['parceiro']['email']); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Proposta CIMA SAÚDE');
			//$logo = $this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg', 'inline');	 

			
	        /*
	         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
	         * caso contrário passa somente o conteúdo do campo 'mensagem'
	         */
	        //if(isset($dados['template']))
	        //    $this->email->message($this->load->view('contratos/propostas/email-templates',$dados, TRUE));
	        //else

	        $message = 'Olá, estamos muito felizes de realizar essa parceria. Segue em anexo o seu contrato.<br>Qualquer dúvida estamos à disposição<br><br>';
	        $message .='Atenciosamente, <br>Depto. Comercial CIMA SAÚDE<br><br>';
	        
	        
	        $logo = 'C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg';
			$this->email->attach($logo, 'inline');
        	$cid = $this->email->attachment_cid($logo);
        	$message .= '<img src="cid:'. $cid .'" alt="photo1" />';


        	$this->email->message($message);
	 		$this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-Parceiro-'. $data['parceiro']['cod_parceiro'] .'.pdf');
	 
			

        	//Exclui o arquivo PDF do servidor
			unlink('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-Parceiro-'. $data['parceiro']['cod_parceiro'] .'.pdf');
			

	        //Envia o email e redireciona para a página
	        if($this->email->send())
	        {
	            $this->session->set_flashdata('msg','Proposta salva e e-mail enviado com sucesso!');
	            redirect('parceiros');
	        }
	        else
	        {
	            $this->session->set_flashdata('msg', 'Proposta salva e e-mail não enviado! ERROR: '.$this->email->print_debugger());
	            redirect('parceiros');
	        }
		}

		public function visualizar($cod){
		
			$data['parceiro'] = $this->Generic_model->readById('parceiros', 'cod_parceiro', $cod);

			$data['especialidades']= $this->Generic_model->readAllWhere('especialidades_parceiros', 'fk_parceiro', $cod);
			
			for($i = 0; $i < count($data['especialidades']); $i++){
				$r = $this->Generic_model->readById('especialidades', 'cod_especialidade', $data['especialidades'][$i]['fk_especialidade']);
				$data['nomesEspecialidades'][$i] = $r['nome'];
			}
			if($data['especialidades'] == false) 
				$data['nomesEspecialidades'] == false;

			switch ($data['parceiro']['tipo']) {
				case 'CLÍNICA':
					$data['doc'] = 'cnpj';
					break;
				case 'LABORATÓRIO':
					$data['doc'] = 'cnpj';
					break;
				case 'MÉDICO':
					$data['doc'] = 'CRM';
					break;
				case 'DENTISTA':
					$data['doc'] = 'CRO';
					break;
				case 'FISIOTERAPEUTA/TERAPEUTA':
					$data['doc'] = 'COFFITO';
					break;
				case 'PSICÓLOGO':
					$data['doc'] = 'CRP';
					break;
				case 'NUTRICIONISTA':
					$data['doc'] = 'CFN';
					break;
				
				default:
					# code...
					break;
			}

			$data['parceiro']['data'] = date("Y-m-d");
			$data['parceiro']['texto'] = '';

			

			
			if(count($data['nomesEspecialidades']) == 1 && $data['nomesEspecialidades'][0] == NULL){
				$data['parceiro']['texto'] = '';

			}else{

				if(count($data['nomesEspecialidades']) == 1)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0];

				if(count($data['nomesEspecialidades']) == 2)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ' e ' . $data['nomesEspecialidades'][1]; 
				if(count($data['nomesEspecialidades']) == 3)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ', ' . $data['nomesEspecialidades'][1] . ' e ' . $data['nomesEspecialidades'][2];
				if(count($data['nomesEspecialidades']) == 4)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ', ' . $data['nomesEspecialidades'][1] . ', ' . $data['nomesEspecialidades'][2] . ' e ' . $data['nomesEspecialidades'][3] ;
			}
			

			//var_dump($data); die;
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/parceiros/parceiros-view", $data);

		}








		//Método que carrega uma view de formulário para ser vizualizado
		public function novoPDF($cod){
			$data['parceiro'] = $this->Generic_model->readById('parceiros', 'cod_parceiro', $cod);

			$data['especialidades']= $this->Generic_model->readAllWhere('especialidades_parceiros', 'fk_parceiro', $cod);
			
			for($i = 0; $i < count($data['especialidades']); $i++){
				$r = $this->Generic_model->readById('especialidades', 'cod_especialidade', $data['especialidades'][$i]['fk_especialidade']);
				$data['nomesEspecialidades'][$i] = $r['nome'];
			}
			if($data['especialidades'] == false) 
				$data['nomesEspecialidades'] == false;

			switch ($data['parceiro']['tipo']) {
				case 'CLÍNICA':
					$data['doc'] = 'cnpj';
					break;
				case 'LABORATÓRIO':
					$data['doc'] = 'cnpj';
					break;
				case 'MÉDICO':
					$data['doc'] = 'CRM';
					break;
				case 'DENTISTA':
					$data['doc'] = 'CRO';
					break;
				case 'FISIOTERAPEUTA/TERAPEUTA':
					$data['doc'] = 'COFFITO';
					break;
				case 'PSICÓLOGO':
					$data['doc'] = 'CRP';
					break;
				case 'NUTRICIONISTA':
					$data['doc'] = 'CFN';
					break;
				
				default:
					# code...
					break;
			}

			$data['parceiro']['data'] = date("Y-m-d");
			$data['parceiro']['texto'] = '';

			

			
			if(count($data['nomesEspecialidades']) == 1 && $data['nomesEspecialidades'][0] == NULL){
				$data['parceiro']['texto'] = '';

			}else{

				if(count($data['nomesEspecialidades']) == 1)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0];

				if(count($data['nomesEspecialidades']) == 2)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ' e ' . $data['nomesEspecialidades'][1]; 
				if(count($data['nomesEspecialidades']) == 3)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ', ' . $data['nomesEspecialidades'][1] . ' e ' . $data['nomesEspecialidades'][2];
				if(count($data['nomesEspecialidades']) == 4)
					$data['parceiro']['texto'] = $data['nomesEspecialidades'][0] . ', ' . $data['nomesEspecialidades'][1] . ', ' . $data['nomesEspecialidades'][2] . ' e ' . $data['nomesEspecialidades'][3] ;
			}
			
			//echo "novoPDF";
			//var_dump(count($data['nomesEspecialidades']), $data['nomesEspecialidades'], $data['parceiro']['texto']); die;

			//var_dump($data['dependentes']); die;
				//var_dump($data); die;
				// Instancia a classe mPDF
				$mpdf = new mPDF();

				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('contratos/contrato-template/template-parceiro', $data, TRUE);
				$mpdf->AddPage('','','','','');
				// Define um Cabeçalho para o arquivo PDF
				$mpdf->SetHeader('CIMA SAÚDE');
				// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
				// página através da pseudo-variável PAGENO
				$mpdf->SetFooter('
					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none; border-collapse:collapse;"> 
					<tr style="border: none;">

						<td width="50%" style="border: none;"><span style="font-weight: bold; font-style: italic;">www.cimasaude.com.br</span></td>

						<td width="50%" style="text-align: right; border: none;">{PAGENO}</td>

						</tr>
					</table>
					');
				// Insere o conteúdo da variável $html no arquivo PDF
				$mpdf->writeHTML($html);
				// Cria uma nova página no arquivo
				//$mpdf->AddPage();
				// Insere o conteúdo na nova página do arquivo PDF
				//$mpdf->WriteHTML('<p><b>Minha nova página no arquivo PDF</b></p>');
				// Gera o arquivo PDF
				//$mpdf->Output();
				$mpdf->Output('Contrato-Parceiro-'. $data['parceiro']['cod_parceiro'] .'.pdf' , 'D');
				return;
		}

		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************


		public function relatorios(){
			
			
			$data['form'] = $this->input->post();
			$groupBy = '';
			$orderBy = '';
			$campos = "parceiros.*";
			$tables = "parceiros";
			$where = " ";

			if($data['form']['c-inicial'] != ''){
				$where .= ' parceiros.dt_cadastro >= "' . formata_data_db($data['form']['c-inicial']). '" AND';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' parceiros.dt_cadastro <= "' . formata_data_db($data['form']['c-final']). '" AND';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'parceiros.dt_cadastro, ';
				
			}


			if($data['form']['status'] != ''){
				$where .= ' status = "' . $data['form']['status'] . '" AND';
				$groupBy .= 'status,';

			}

			//Tirando o último AND e a última vírgula
			//if($where != 'propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano '){
				$where = substr($where, 0 , -4);
			//}
			if($groupBy != ''){
				$groupBy = substr($groupBy, 0 , -1);
			}

			//var_dump($data, $where, $groupBy, $orderBy, "-------------------------************************_______________________");
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'dt_cadastro');

			
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/parceiros", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/parceiros', $data, TRUE);
			$mpdf->AddPage('','','','','');
			$mpdf->SetHeader('CIMA SAÚDE');
			$mpdf->SetFooter('
				<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none; border-collapse:collapse;"> 
				<tr style="border: none;">

					<td width="50%" style="border: none;"><span style="font-weight: bold; font-style: italic;">www.cimasaude.com.br</span></td>

					<td width="50%" style="text-align: right; border: none;">{PAGENO}</td>

					</tr>
				</table>
			');
			$mpdf->writeHTML($html);
			$mpdf->Output('Relatorio-Parceiros'. date("Ymd").'.pdf' , 'D');
			 redirect('parceiros');
		}

	}	


