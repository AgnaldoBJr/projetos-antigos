<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Guia extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
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
			
			$sql = 'SELECT * FROM guias_atendimento, beneficiarios WHERE guias_atendimento.fk_paciente = beneficiarios.cod AND guias_atendimento.fk_tabela = beneficiarios.tab;';
			$data['dataTable'] = $this->Generic_model->justQuery($sql);
			//var_dump($data['dataTable']);
			for($i = 0; $i < count($data['dataTable']); $i++) {
				$resultado = $this->Generic_model->readById('parceiros', 'cod_parceiro', $data['dataTable'][$i]['fk_realizador']);

				$data['dataTable'][$i]['parceiro'] = $resultado['nome'];
			}

			
			
			$sql = 'SELECT servicos.*, parceiros.nome as parceiro, exames.nome as exame FROM servicos left join parceiros on servicos.fk_parceiro = parceiros.cod_parceiro left join exames on servicos.fk_exame = exames.cod_exame';
			$data['dataServicos'] = $this->Generic_model->justQuery($sql);



			
			
			//var_dump($data); die;
			$this->load->view('processos/guias/guias-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}

		//Método que renderiza a tela
		public function novo(){
			
			$table = 'servicos';
			$campoId = 'fk_parceiro';
			$id = $this->session->userdata('id');

			//var_dump($this->session->userdata()); die;
			
			$query = 'SELECT servicos.*, exames.nome as nom FROM servicos left join  exames on servicos.fk_exame = exames.cod_exame';
			$data['dataServicos'] = $this->Generic_model-> justQuery($query);

			$sql = 'SELECT * FROM beneficiarios';
			$data['dataPacientes'] = $this->Generic_model->justQuery($sql);

			$sql = 'SELECT * FROM parceiros';
			$data['dataParceiros'] = $this->Generic_model->justQuery($sql);

			$this->load->view('commons/sidebar');
			$this->load->view("processos/guias/atendimentos-create", $data);
		}
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  die;		
			$data = $this->input->post();

			//var_dump($data['valor'], $guia_servico);  
			//die;
			//Inserir o codigo do dependente e a tabela
			$codigos = explode('-', $this->input->post('beneficiario'));
			$data['fk_paciente'] = $codigos[0];
			$data['fk_tabela'] = $codigos[1];
            //var_dump($data['fk_paciente'], $data['fk_tabela']);  
			//var_dump($codigos);
			$data = parseGuia($data, $this->session->userdata('id'));
			//var_dump($data); die;
			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);


			//Inserir os servicos
			//var_dump($resultado); die;

			for($i = 0; $i <= 200 ; $i++){
				if($this->input->post('servico-'. $i)!= null){
					$dataServico = array('fk_guia' => $resultado['cod_guia'],
										 'fk_servico' => $i );

					$r = $this->Generic_model->insert('guias_servico', 'cod_guia_servico', $dataServico);
				}
			}
			

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Guia salva com sucesso!');	
					redirect('guias');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('guias');
			}
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/parceiros/parceiros-update", $resultado);
			
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizarStatus(){
			//var_dump($this->input->post()); die;

			$data = array('status' => $this->input->post('status'));
			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			$id = $this->input->post('cod_guia');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('guias');
      		}
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $this->input->post('cod_parceiro');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('parceiros');
      		}
	      	
		}

		

		public function visualizar($cod){

			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			$id = $cod;
			$data['dataGuia'] = $this->Generic_model->readById($table, $campoId, $id);

			$data['dataGuia']['status'] = $this->parseStatus($data['dataGuia']['status']);
			$data['dataGuia']['valor_tipo'] = $this->parsePagamento($data['dataGuia']['valor_tipo']);


			$table = 'beneficiario';
			$query = 'SELECT * FROM beneficiarios WHERE cod = ' .$data['dataGuia']['fk_paciente']. ' AND tab = ' .$data['dataGuia']['fk_tabela']; 
			$resultado = $this->Generic_model->justQuery($query);
			
			$data['dataBeneficiario'] = $resultado[0]; 
			$tab = $data['dataBeneficiario']['tab'];
			

			if($tab == 1){
				
				$data['dataBeneficiario']['tipo'] = 'Titular';
			} else if ($tab == 2){
				
				$data['dataBeneficiario']['tipo'] = 'Dependente';
			}else if ($tab == 3){
				
				$data['dataBeneficiario']['tipo'] = 'Agregado';
			}else if ($tab == 4){
				
				$data['dataBeneficiario']['tipo'] = 'Colaborador';
			}


			$table = 'guias_servicos_view';
			$campoId = 'fk_guia';
			$id = $cod;
			$data['dataServicos'] = $this->Generic_model->readAllWhere($table, $campoId, $id);
			//echo '<pre>';
			//var_dump($data['dataGuia'], $data['dataServicos'], $data['dataBeneficiario']);
			//echo '</pre>';
			$this->load->view('commons/sidebar');
			$this->load->view("processos/guias/atendimentos-view", $data);

		}

		public function novoPDF($cod){
			//var_dump($cod);

			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			$id = $cod;
			$data['dataGuia'] = $this->Generic_model->readById($table, $campoId, $id);

			$data['dataGuia']['status'] = $this->parseStatus($data['dataGuia']['status']);
			$data['dataGuia']['valor_tipo'] = $this->parsePagamento($data['dataGuia']['valor_tipo']);


			$table = 'beneficiario';
			$query = 'SELECT * FROM beneficiarios WHERE cod = ' .$data['dataGuia']['fk_paciente']. ' AND tab = ' .$data['dataGuia']['fk_tabela']; 
			$resultado = $this->Generic_model->justQuery($query);
			
			$data['dataBeneficiario'] = $resultado[0]; 
			$tab = $data['dataBeneficiario']['tab'];
			

			if($tab == 1){
				
				$data['dataBeneficiario']['tipo'] = 'Titular';
			} else if ($tab == 2){
				
				$data['dataBeneficiario']['tipo'] = 'Dependente';
			}else if ($tab == 3){
				
				$data['dataBeneficiario']['tipo'] = 'Agregado';
			}else if ($tab == 4){
				
				$data['dataBeneficiario']['tipo'] = 'Colaborador';
			}


			$table = 'guias_servicos_view';
			$campoId = 'fk_guia';
			$id = $cod;
			$data['dataServicos'] = $this->Generic_model->readAllWhere($table, $campoId, $id);
			



			$mpdf = new mPDF();

				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('atendimentos/atendimentos/atendimentos-pdf', $data, TRUE);
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
				
				$mpdf->Output('Guia-Atendimento'.$data['dataGuia']['cod_guia']. date('Ydm').'.pdf' , 'D');
				return;

		}

		

		public function parseStatus($status){
			switch ($status) {
				case 'p':
					$status = 'Pendente';
					break;
				case 'c':
					$status = 'Confirmada';
					break;
				case 'a':
					$status = 'Atendido';
					break;
				case 'n':
					$status = 'Não Compareceu';
					break;
				case 'l':
					$status = 'Cancelado';
					break;
				
				default:
					$status = '';
					break;
			}
			return $status;

		}

		public function parsePagamento($tipoPagamento){
			switch ($tipoPagamento) {
				case 'p':
					$tipoPagamento = 'Parceiro';
					break;
				case 'c':
					$tipoPagamento = 'CIMA';
					break;
				case 'r':
					$tipoPagamento = 'Recibo';
					break;
				default:
					$tipoPagamento = '';
					break;
			}
			return $tipoPagamento;

		}

		public function delete(){
			//var_dump($this->input->post()); die;
			$data = $this->input->post('cod_guia');
			$table = 'guias_atendimento';
			$campoId = 'cod_guia';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);


			$table = 'guias_servico';
			$campoId = 'fk_guia';
			$id = $this->input->post('cod_guia');
			$this->Generic_model->delete($table, $campoId, $id);


			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Guia excluída com sucesso!');	
					redirect('guias');  		
		    } else{
					$this->session->set_flashdata('err', 'Não excluída! Tente novamente!');
					redirect('guias');
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/guias_atendimento', $data, TRUE);
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
			$mpdf->Output('Relatorio-Contas-Pagar'. date("Ymd").'.pdf' , 'D');
			 redirect('contas-a-pagar');
		}
	
	
	}	