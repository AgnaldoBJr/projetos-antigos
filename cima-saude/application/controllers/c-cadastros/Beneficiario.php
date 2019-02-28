<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Beneficiario extends CI_Controller {

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
			$table = 'beneficiarios';
			$data['dataTable'] = $this->Generic_model->readAll($table);

		/*	
			for($i = 0; $i <= count($data['dataTable']); $i++) {
				$num = $data['dataTable'][$i]['fk_proposta'];
				$query = "SELECT dt_vencimento FROM contratos WHERE cod_proposta = " . $num . ' LIMIT 1';
				$dta = $this->Generic_model->justQuery($query);

				var_dump($dta[0]); 
				if($dta[0]){
					 $data['dataTable'][$i]['status'] = "Ativo";
				} else {
					 $data['dataTable'][$i]['status'] = "Inativo";
				}


			}
			var_dump($data['dataTable']);die;*/
			$this->load->view('cadastros/beneficiarios/beneficiarios-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function visualizar($cod, $tab){
			//var_dump($cod, $tab, 'deu certo!');
			if($tab == 1){
				$table = 'clientes';
				$campoId = 'cod_cliente';
				$data['tipo_beneficiario'] = 'Titular';
			} else if ($tab == 2){
				$table = 'propostas_dependentes';
				$campoId = 'cod_dependente';
				$data['tipo_beneficiario'] = 'Dependente';
			}else if ($tab == 3){
				$table = 'propostas_agregados';
				$campoId = 'cod_agregado';
				$data['tipo_beneficiario'] = 'Agregado';
			}else if ($tab == 4){
				$table = 'propostas_colaboradores';
				$campoId = 'cod_colaborador';
				$data['tipo_beneficiario'] = 'Colaborador';
			}
			$data['cod'] = $cod;
			$data['tab'] = $tab;

			$data['beneficiario'] = $this->Generic_model->readById($table, $campoId, $cod);




			//var_dump($data); die;
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/beneficiarios/beneficiarios-view", $data);
		}

		public function atualizar($cod, $tab){
			//var_dump($cod, $tab, 'deu certo! ATUALIZANDO...');

			if($tab == 1){
				$table = 'clientes';
				$campoId = 'cod_cliente';
				$data['tipo_beneficiario'] = 'Titular';
			} else if ($tab == 2){
				$table = 'propostas_dependentes';
				$campoId = 'cod_dependente';
				$data['tipo_beneficiario'] = 'Dependente';
			}else if ($tab == 3){
				$table = 'propostas_agregados';
				$campoId = 'cod_agregado';
				$data['tipo_beneficiario'] = 'Agregado';
			}else if ($tab == 4){
				$table = 'propostas_colaboradores';
				$campoId = 'cod_colaborador';
				$data['tipo_beneficiario'] = 'Colaborador';
			}
			
			$data['beneficiario'] = $this->Generic_model->readById($table, $campoId, $cod);
			$data['beneficiario']['cod'] = $cod;
			$data['beneficiario']['tab'] = $tab;
			$data['beneficiario']['tipo_beneficiario'] = $data['tipo_beneficiario'];
			//var_dump($data['beneficiario']); die;
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/beneficiarios/beneficiarios-update", $data['beneficiario']);
		}	

		public function alterar(){
			var_dump($this->input->post());
			$tab = $this->input->post('tab');
			$id = $this->input->post('cod');
			if($tab == 1){
				$table = 'clientes';
				$campoId = 'cod_cliente';
				$data['tipo_beneficiario'] = 'Titular';
			} else if ($tab == 2){
				$table = 'propostas_dependentes';
				$campoId = 'cod_dependente';
				$data['tipo_beneficiario'] = 'Dependente';
			}else if ($tab == 3){
				$table = 'propostas_agregados';
				$campoId = 'cod_agregado';
				$data['tipo_beneficiario'] = 'Agregado';
			}else if ($tab == 4){
				$table = 'propostas_colaboradores';
				$campoId = 'cod_colaborador';
				$data['tipo_beneficiario'] = 'Colaborador';
			}

			$data = $this->parseData($this->input->post());

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);
			if($resultado == true){
	      		$this->session->set_flashdata('msg', 'Alterado com sucesso!');
	      		redirect('beneficiarios');
	      			
		    } else{
				$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
      			redirect('beneficiarios');
			}


		}	
		
		public function parseData($data){

			$parseData = array(
				
				'nome' => $data['cliente-nome'],
				'data_nasc' => ($data['tab'] != '1') ? formata_data_db($data['cliente-data-nasc']) : $data['cliente-data-nasc'],
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
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"),
				'tab' => $data['tab']);

			return $parseData;
		}
	}	