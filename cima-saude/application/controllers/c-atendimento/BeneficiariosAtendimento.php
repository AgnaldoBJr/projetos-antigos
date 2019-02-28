<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class BeneficiariosAtendimento extends CI_Controller {

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
			if($this->session->userdata('is_logged_in') != 2){
				$this->logout();
				redirect('atendimento/login');
			}
			//---------------

			//var_dump($this->session->userdata);die;
			$this->load->view('commons/atendimento/head-atendimento');
			$this->load->view('commons/atendimento/header-atendimento');
			
			$sql = 'SELECT * FROM pessoas';
			
			$data['dataTable'] = $this->Generic_model->justQuery($sql);
			
			//var_dump($data); die;
			$this->load->view('atendimento/beneficiarios-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}


		public function contar(){
			//var_dump($this->input->post());
			$data = array('fk_parceiro' => $this->session->userdata('id'),
						'fK_pessoa' => $this->input->post('cod_pessoa'),
						'cadastro' => date("Y-m-d H:i:s"));

			$table = 'logs_parceiro';
			$campoId = 'cod_log';
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

			redirect('atendimento/beneficiarios');
		}



		public function visualizar($cod, $tab){
			//var_dump($cod, $tab, 'deu certo! VIZUALIZANDO');die;
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
			$data['beneficiario']['cod'] = $cod;



			//var_dump($data); die;
			$this->load->view('commons/atendimento/head-atendimento');
			$this->load->view('commons/atendimento/header-atendimento');
			$this->load->view("atendimentos/clientes/beneficiarios-view", $data);
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
			$this->load->view('commons/atendimento/head-atendimento');
			$this->load->view('commons/atendimento/header-atendimento');
			$this->load->view("atendimentos/clientes/beneficiarios-update", $data['beneficiario']);
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
	      		redirect('atendimento/clientes');
	      			
		    } else{
				$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
      			redirect('atendimento/clientes');
			}


		}

		public function parseData($data){

			$parseData = array(
				
				'nome' => $data['cliente-nome'],
				'data_nasc' => ($data['id'] != '1') ? formata_data_db($data['cliente-data-nasc']) : $data['cliente-data-nasc'],
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
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  die;		
			$data = parseServico($this->input->post());
			$table = 'servicos';
			$campoId = 'cod_servico';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Serviço salvo com sucesso!');	
					redirect('servicos');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('servicos');
			}
		}
/*
		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/parceiros/parceiros-update", $resultado);
			
		}
*/
		//Método que altera os dados no banco a partir de um formulário carregado
/*		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $this->input->post('cod_parceiro');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('parceiros');
      		}
	      	
		}
*/
		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_parceiro');
			$table = 'parceiros';
			$campoId = 'cod_parceiro';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('parceiros');
      		}
		}



	
	}	