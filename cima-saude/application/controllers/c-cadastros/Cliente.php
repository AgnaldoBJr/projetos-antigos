<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Cliente extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
			$this->load->helper('parse');
			$this->load->helper("file");
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
			$table = 'clientes';
			$data['dataTable'] = $this->Generic_model->readAll($table);

			//var_dump($data['dataTable']);die;
			$table = "planos";
			$data['dataPlanos'] = $this->Generic_model->readAll($table);
			//var_dump($data['dataClientes'], $data['dataPlanos']); die;
			$this->load->view('cadastros/clientes/clientes-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/clientes/clientes-create");
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post()); die;
			
			//Validação dados gerais para pessoa física
			if($this->input->post("cliente-tipo") == "1"){
				
				$this->form_validation->set_rules('cliente-nome', 'Nome', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('cliente-cpf', 'CPF', 'required|trim|callback_validate_cpf');
				$this->form_validation->set_rules('cliente-rg', 'RG', 'required|trim');
				$this->form_validation->set_rules('cliente-data-nasc', 'Dt. Nasc', 'required|trim');
	            $this->form_validation->set_rules('cliente-genero', 'Sexo', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('cliente-estado-civil', 'Estado Civil', 'required', array('required' => 'Escolha uma opção'));

				//Validação do endereço
				$this->form_validation->set_rules('endereco-logradouro', 'Logradouro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-numero', 'Número', 'required|trim|min_length[1]|max_length[8]');
				$this->form_validation->set_rules('endereco-bairro', 'Bairro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-cidade', 'Cidade', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-estado', 'Estado', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('endereco-cep', 'CEP', 'required|trim');

				//Validação contato
				$this->form_validation->set_rules('cliente-telefone', 'Telefone', 'required|trim');
				$this->form_validation->set_rules('cliente-celular', 'Celular', 'required|trim');
				$this->form_validation->set_rules('cliente-email', 'E-mail', 'required|valid_email|trim|min_length[5]');


				//Mensagens de Validação
				$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
				$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
				$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				$this->form_validation->set_message('valid_email', 'Digite um email válido!');
				$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');

				$data['error_database'] = null;
				if($this->form_validation->run()){
					$data = $this->parseData($this->input->post());
					
					//var_dump($data); die;
					$table = 'clientes';
					$campoId = 'cod_cliente';

					//var_dump($this->input->post(), $data); die;
					$resultado = $this->Generic_model->insert($table, $campoId, $data);


					//*******************************************************************
					//**************** SALVAR DADOS NA TABELA PESSOAS *******************
					//*******************************************************************
					$data['tipo'] = '';
					$data['fk_contrato'] = '';
					$data['carteirinha'] = '';
					$data['status'] = 'i';

					$table = 'pessoas';
					$campoId = 'cod_pessoa';
					$data = parsePessoa($data, $this->session->userdata('id'));
					$resultado = $this->Generic_model->insert($table, $campoId, $data);
							
					//var_dump($data); die;
				

					//*******************************************************************
					if($resultado == true){
					
	      				$this->session->set_flashdata('msg', 'Cadastrado com sucesso!');
	      				redirect('clientes/novo');
	      			
		      		}
		      		else{
						$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
		      			redirect('clientes/novo');
					}
		      	}
		      	$this->load->view('commons/sidebar');
				$this->load->view("cadastros/clientes/clientes-create", $data);
			}
			


			//Validação dados gerais para pessoa jurídica
			else if($this->input->post("cliente-tipo") == "2"){
				//var_dump($this->input->post("o-parceiro")); die;
				$this->form_validation->set_rules('pj-razao-social', 'Razão Social', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('pj-cnpj', 'CNPJ', 'required|trim|callback_validate_cnpj');
				
				$this->form_validation->set_rules('pj-representante', 'Representante', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('pj-cpf', 'CPF', 'required|trim|callback_validate_cpf');
				$this->form_validation->set_rules('pj-rg', 'RG', 'required|trim');
				

				//Validação do endereço
				$this->form_validation->set_rules('endereco-logradouro-pj', 'Logradouro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-numero-pj', 'Número', 'required|trim|min_length[1]|max_length[8]');
				$this->form_validation->set_rules('endereco-bairro-pj', 'Bairro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-cidade-pj', 'Cidade', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-estado-pj', 'Estado', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('endereco-cep-pj', 'CEP', 'required|trim');

				//Validação contato
				$this->form_validation->set_rules('completo-telefone', 'Telefone', 'required|trim');
				$this->form_validation->set_rules('completo-celular', 'Celular', 'required|trim');
				$this->form_validation->set_rules('completo-email', 'E-mail', 'required|valid_email|trim|min_length[5]');


				//Mensagens de Validação
				$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
				$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
				$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				$this->form_validation->set_message('valid_email', 'Digite um email válido!');
				$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');

				$data['error_database'] = null;
				if($this->form_validation->run()){
					//var_dump($this->input->post("o-parceiro")); die;
					$data = $this->parseDataPj($this->input->post());
				
					//var_dump($data); die;
					$table = 'clientes';
					$campoId = 'cod_cliente';

					//var_dump($this->input->post(), $data); die;
					$resultado = $this->Generic_model->insert($table, $campoId, $data);

					if($resultado == true){
					
	      			$this->session->set_flashdata('msg', 'Cadastrado com sucesso!');
	      			redirect('clientes/novo');
	      			
	      		}
	      		else{
					$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
	      			redirect('clientes/novo');
				}
		      	}
		      	$this->load->view('commons/sidebar');
				$this->load->view("cadastros/clientes/clientes-create", $data);
			}
		}



		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			$table = 'clientes';
			$campoId = 'cod_cliente';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			//var_dump($resultado); die;
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/clientes/clientes-update", $resultado);
			
		}



		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			//var_dump($this->input->post()); die;
			
			//Validação dados gerais para pessoa física
			if($this->input->post("cliente-tipo") == "1"){
				
				$this->form_validation->set_rules('cliente-nome', 'Nome', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('cliente-cpf', 'CPF', 'required|trim|callback_validate_cpf');
				$this->form_validation->set_rules('cliente-rg', 'RG', 'required|trim');
				$this->form_validation->set_rules('cliente-data-nasc', 'Dt. Nasc', 'required|trim');
	            $this->form_validation->set_rules('cliente-genero', 'Sexo', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('cliente-estado-civil', 'Estado Civil', 'required', array('required' => 'Escolha uma opção'));

				//Validação do endereço
				$this->form_validation->set_rules('endereco-logradouro', 'Logradouro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-numero', 'Número', 'required|trim|min_length[1]|max_length[8]');
				$this->form_validation->set_rules('endereco-bairro', 'Bairro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-cidade', 'Cidade', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-estado', 'Estado', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('endereco-cep', 'CEP', 'required|trim');

				//Validação contato
				$this->form_validation->set_rules('cliente-telefone', 'Telefone', 'required|trim');
				$this->form_validation->set_rules('cliente-celular', 'Celular', 'required|trim');
				$this->form_validation->set_rules('cliente-email', 'E-mail', 'required|valid_email|trim|min_length[5]');


				//Mensagens de Validação
				$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
				$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
				$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				$this->form_validation->set_message('valid_email', 'Digite um email válido!');
				$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');

				$data['error_database'] = null;
				if($this->form_validation->run()){
					$data = $this->parseData($this->input->post());
					$table = 'clientes';
					$campoId = 'cod_cliente';
					$id = $this->input->post('cod_cliente');

					$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

					if($resultado == true){
					
	      			$this->session->set_flashdata('msg', 'Alterado com sucesso!');
	      			redirect('clientes');
	      			
		      		}
		      		else{
						$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
		      			redirect('clientes');
					}
				}
				
			}	
				//Validação dados gerais para pessoa jurídica
			else if($this->input->post("cliente-tipo") == "2"){
				//var_dump($this->input->post("o-parceiro")); die;
				$this->form_validation->set_rules('pj-razao-social', 'Razão Social', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('pj-cnpj', 'CNPJ', 'required|trim|callback_validate_cnpj');
				
				$this->form_validation->set_rules('pj-representante', 'Representante', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('pj-cpf', 'CPF', 'required|trim|callback_validate_cpf');
				$this->form_validation->set_rules('pj-rg', 'RG', 'required|trim');
				

				//Validação do endereço
				$this->form_validation->set_rules('endereco-logradouro-pj', 'Logradouro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-numero-pj', 'Número', 'required|trim|min_length[1]|max_length[8]');
				$this->form_validation->set_rules('endereco-bairro-pj', 'Bairro', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-cidade-pj', 'Cidade', 'required|trim|min_length[5]');
				$this->form_validation->set_rules('endereco-estado-pj', 'Estado', 'required', array('required' => 'Escolha uma opção'));
				$this->form_validation->set_rules('endereco-cep-pj', 'CEP', 'required|trim');

				//Validação contato
				$this->form_validation->set_rules('completo-telefone', 'Telefone', 'required|trim');
				$this->form_validation->set_rules('completo-celular', 'Celular', 'required|trim');
				$this->form_validation->set_rules('completo-email', 'E-mail', 'required|valid_email|trim|min_length[5]');


				//Mensagens de Validação
				$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
				$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
				$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				$this->form_validation->set_message('valid_email', 'Digite um email válido!');
				$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');

				$data['error_database'] = null;
				if($this->form_validation->run()){
					$data = $this->parseDataPj($this->input->post());
					$table = 'clientes';
					$campoId = 'cod_cliente';
					$id = $this->input->post('cod_cliente');

					$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

					if($resultado == true){
					
	      			$this->session->set_flashdata('msg', 'Alterado com sucesso!');
	      			redirect('clientes');
	      			
		      		}
		      		else{
						$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
		      			redirect('clientes');
					}
		      	}
		      	
			}
				$table = 'clientes';
				$campoId = 'cod_cliente';
				$id = $this->input->post('cod_cliente');
				
				$resultado = $this->Generic_model->readById($table, $campoId, $id);

				//var_dump($resultado); die;
				$this->load->view('commons/sidebar');
				$this->load->view("cadastros/clientes/clientes-update", $resultado); 	
		
		}



		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_cliente');
			$table = 'clientes';
			$campoId = 'cod_cliente';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
				$this->session->set_flashdata('msg', 'Excluído com sucesso!');
      			redirect('clientes');
      		}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			if(!isset($data['o-colaborador'])){
				$data['o-colaborador'] = '0';
			}

			$parseData = array(
				'tipo' => $data['cliente-tipo'],
				'nome' => $data['cliente-nome'],
				'data_nasc' => $data['cliente-data-nasc'],
				'cpf' => $data['cliente-cpf'],
				'rg' => $data['cliente-rg'],
				'sexo' => $data['cliente-genero'],
				'estado_civil' => $data['cliente-estado-civil'],
				'telefone' => $data['cliente-telefone'],
				'celular' => $data['cliente-celular'],
				'email' => $data['cliente-email'],
				'logradouro' => $data['endereco-logradouro'],
				'numero' => $data['endereco-numero'],
				'bairro' => $data['endereco-bairro'],
				'cidade' => $data['endereco-cidade'],
				'estado' => $data['endereco-estado'],
				'cep' => $data['endereco-cep'],
				'complemento' => $data['endereco-complemento'],
				'e_colaborador' => $data['o-colaborador'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"),
				'tab' => 1);

			return $parseData;
		}

		public function parseDataPj($data){
			if(!isset($data['o-parceiro'])){
				$data['o-parceiro'] = '0';
			}

			
			if(!isset($data['o-fornecedor'])){
				$data['o-fornecedor'] = '0';
			}
			//var_dump($data['o-parceiro']); var_dump($data); die;
			//var_dump($data['o-parceiro']); var_dump($data['o-fornecedor']); die;
			$parseData = array(
				'tipo' => $data['cliente-tipo'],
				'nome' => $data['pj-representante'],
				//'data_nasc' => $data['cliente-data-nasc'],
				'cpf' => $data['pj-cpf'],
				'rg' => $data['pj-rg'],
				//'sexo' => $data['cliente-genero'],
				//'estado_civil' => $data['cliente-estado-civil'],
				'razao_social' => $data['pj-razao-social'],
				'nome_fantasia' => $data['pj-fantasia'],
				'cnpj' => $data['pj-cnpj'],
				
				'representante_sec' => $data['pj-representante-2'],
				'cpf_representante' => $data['pj-cpf-2'],
				'rg_representante' => $data['pj-rg-2'],

				'telefone' => $data['completo-telefone'],
				'celular' => $data['completo-celular'],
				'email' => $data['completo-email'],
				'site' => $data['completo-site'],
				'logradouro' => $data['endereco-logradouro-pj'],
				'numero' => $data['endereco-numero-pj'],
				'bairro' => $data['endereco-bairro-pj'],
				'cidade' => $data['endereco-cidade-pj'],
				'estado' => $data['endereco-estado-pj'],
				'cep' => $data['endereco-cep-pj'],
				'complemento' => $data['endereco-complemento-pj'],
				'e_parceiro' => $data['o-parceiro'],
				'e_fornecedor' => $data['o-fornecedor'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}
	
		//Função modificada de: http://www.geradorcpf.com/script-validar-cpf-php.htm
		//Data: 13/03/2017
		public function validate_cpf($cpf){
		    // Elimina possivel mascara
		    $cpf = preg_replace('/[^0-9]/', '', $cpf);
		    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		    
		    // Verifica se o numero de digitos informados é igual a 11 
		    if (strlen($cpf) != 11) {
		        $this->form_validation->set_message('validate_cpf', 'CPF inválido');
		        return false;
		    }
		    // Verifica se nenhuma das sequências invalidas abaixo 
		    // foi digitada. Caso afirmativo, retorna falso
		    else if ($cpf == '00000000000' || 
		        $cpf == '11111111111' || 
		        $cpf == '22222222222' || 
		        $cpf == '33333333333' || 
		        $cpf == '44444444444' || 
		        $cpf == '55555555555' || 
		        $cpf == '66666666666' || 
		        $cpf == '77777777777' || 
		        $cpf == '88888888888' || 
		        $cpf == '99999999999') {
		    	$this->form_validation->set_message('validate_cpf', 'CPF inválido');
		        return false;
		     // Calcula os digitos verificadores para verificar se o
		     // CPF é válido
		     } else {   
		         
		        for ($t = 9; $t < 11; $t++) {
		             
		            for ($d = 0, $c = 0; $c < $t; $c++) {
		                $d += $cpf{$c} * (($t + 1) - $c);
		            }
		            $d = ((10 * $d) % 11) % 10;
		            if ($cpf{$c} != $d) {
		                $this->form_validation->set_message('validate_cpf', 'CPF inválido');
		                return false;
		            }
		        }
		 
		        return true;
		    }
		}

		//Função modificada de: https://gist.github.com/guisehn/3276302
		//Data: 13/03/2017
		public function validate_cnpj($cnpj){
			$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
			// Valida tamanho
			if (strlen($cnpj) != 14){
				$this->form_validation->set_message('validate_cnpj', 'CNPJ inválido');
				return false;
			}

			// Valida primeiro dígito verificador
			for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
			{
				$soma += $cnpj{$i} * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)){
				$this->form_validation->set_message('validate_cnpj', 'CNPJ inválido');
				return false;
			}

			// Valida segundo dígito verificador
			for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
			{
				$soma += $cnpj{$i} * $j;
				$j = ($j == 2) ? 9 : $j - 1;
			}
			$resto = $soma % 11;
			//return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);

			if ($cnpj{13} == ($resto < 2 ? 0 : 11 - $resto))
                {
                    return TRUE;
                }
                else
                {
                    $this->form_validation->set_message('validate_cnpj', 'CNPJ inválido');
                    return FALSE;
                }
		}


		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************


		public function relatorios(){
			
			
			$data['form'] = $this->input->post();
			$groupBy = '';
			$orderBy = '';
			$campos = "clientes_contratos.*";
			$tables = "clientes_contratos";
			$where = " ";

			if($data['form']['c-inicial'] != ''){
				$where .= ' clientes_contratos.cadastro >= "' . formata_data_db($data['form']['c-inicial']). '" AND';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' clientes_contratos.cadastro <= "' . formata_data_db($data['form']['c-final']). '" AND';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'clientes_contratos.cadastro, ';
				
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
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'cadastro');

			//var_dump($data['dataTable']); die;
			
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/clientes", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/clientes', $data, TRUE);
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
			$mpdf->Output('Relatorio-Clientes'. date("Ymd").'.pdf' , 'D');
			 redirect('clientes');
		}
	}	