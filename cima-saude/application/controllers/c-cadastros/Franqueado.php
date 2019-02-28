<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Franqueado extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
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
			$table = "franqueados";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('cadastros/franqueados/franqueados-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/franqueados/franqueados-create");
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
				
			$data = $this->parseData($this->input->post());
			$table = 'franqueados';
			$campoId = 'cod_franqueado';

			//var_dump($this->input->post(), $data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

			if($resultado){
      			redirect('franqueados');
      		}
	      	
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			$table = 'franqueados';
			$campoId = 'cod_franqueado';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/franqueados/franqueados-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'franqueados';
			$campoId = 'cod_franqueado';
			$id = $this->input->post('cod_franqueado');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('franqueados');
      		}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_franqueado');
			$table = 'franqueados';
			$campoId = 'cod_franqueado';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('franqueados');
      		}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			$parseData = array(
					'nome' => $data['nome'],
					'data_nasc' => $data['data_nasc'],
					'cpf' => $data['cpf'],
					'rg' => $data['rg'],
					'sexo' => $data['sexo'],
					'estado_civil' => $data['estado_civil'],
					'fk_unidade' => '1',
					'fk_acesso' => $this->session->userdata('id'),
					'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}
	
	}	