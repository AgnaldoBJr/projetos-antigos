<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Plano extends CI_Controller {

		

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
		
			
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
			$table = "planos";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('contratos/planos/planos-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/planos/planos-create");
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post()); die;
			$data = $this->input->post();

			$this->form_validation->set_rules('plano-nome', 'Nome', 'required|trim|min_length[5]');

			if(isset($data['plano-agregados'])){
				$this->form_validation->set_rules('plano-adicional-agregados', 'Adicional (Agregados)', 'trim');
			}

			if(isset($data['plano-colaboradores'])){
				$this->form_validation->set_rules('plano-adicional-colaboradores', 'Adicional (Colaboradores)', 'trim');
			}
			
			$this->form_validation->set_rules('plano-valor', 'Nome', 'required|trim');
			$this->form_validation->set_rules('plano-validade', 'Validade do contrato', 'required', array('required' => 'Escolha uma opção'));


			//Mensagens de Validação
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				

			if($this->form_validation->run()){
				$data = $this->parseData($this->input->post());
				//var_dump($this->input->post(), $data); die;
				$table = 'planos';
				$campoId = 'cod_plano';

				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado){
	      			redirect('planos');
	      		}
	      	}

	      	$this->load->view('commons/sidebar');
			$this->load->view("contratos/planos/planos-create", $data);

	      	
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			$table = 'planos';
			$campoId = 'cod_plano';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$this->load->view('commons/sidebar');
			$this->load->view("contratos/planos/planos-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			//var_dump($this->input->post()); die;

			$data = $this->input->post();
			
			$this->form_validation->set_rules('plano-nome', 'Nome', 'required|trim|min_length[5]');

			if(isset($data['plano-agregados'])){
				$this->form_validation->set_rules('plano-adicional-agregados', 'Adicional (Agregados)', 'required|trim');
			}

			if(isset($data['plano-colaboradores'])){
				$this->form_validation->set_rules('plano-adicional-colaboradores', 'Adicional (Colaboradores)', 'required|trim');
			}
			
			$this->form_validation->set_rules('plano-valor', 'Nome', 'required|trim');
			$this->form_validation->set_rules('plano-validade', 'Validade do contrato', 'required', array('required' => 'Escolha uma opção'));


			//Mensagens de Validação
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
				

			if($this->form_validation->run()){
				$data = $this->parseData($this->input->post());
				$table = 'planos';
				$campoId = 'cod_plano';
				$id = $this->input->post('cod_plano');

				$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

				if($resultado){
	      			redirect('planos');
	      		}
	      	}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			//var_dump($this->input->post()); die;
			$data = $this->input->post('cod_plano');
			$table = 'planos';
			$campoId = 'cod_plano';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('planos');
      		}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			
			if(!isset($data['plano-dependentes'])){
				$data['plano-dependentes'] = '0';
			}

			if(!isset($data['plano-agregados'])){
				$data['plano-agregados'] = '0';
				$data['plano-adicional-agregados'] = "";
			}

			if(!isset($data['plano-colaboradores'])){
				$data['plano-colaboradores'] = '0';
				$data['plano-adicional-colaboradores'] = "";
			}

			$parseData = array(
				'nome' => $data['plano-nome'],
				'descricao' => $data['plano-descricao'],
				'dependentes' => $data['plano-dependentes'],
				'agregados' => $data['plano-agregados'],
				'colaboradores' => $data['plano-colaboradores'],
				'adicional_agregados' => $data['plano-adicional-agregados'],
				'adicional_colaboradores' => $data['plano-adicional-colaboradores'],
				'valor' => formata_preco_db($data['plano-valor']),
				'validade' => $data['plano-validade'],
				'observacoes' => $data['plano-observacoes'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}	
	}