<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Fornecedor extends CI_Controller {

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
			$table = "fornecedores";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('cadastros/fornecedores/fornecedores-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$this->load->view('commons/sidebar');
			$this->load->view('cadastros/fornecedores/fornecedores-create');
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//echo "oi"; die;	
			$data = parseFornecedor($this->input->post(), $this->session->userdata('id'));
			$table = 'fornecedores';
			$campoId = 'cod_fornecedor';


			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Fornecedor salvo com sucesso!');	
					redirect('fornecedores');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('fornecedores');
			}
	      	
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			$table = 'fornecedores';
			$campoId = 'cod_fornecedor';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/fornecedores/fornecedores-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = parseFornecedor($this->input->post(), $this->session->userdata('id'));
			$table = 'fornecedores';
			$campoId = 'cod_fornecedor';
			$id = $this->input->post('cod_fornecedor');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Fornecedor alterado com sucesso!');	
					redirect('fornecedores');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('fornecedores');
			}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_fornecedor');
			$table = 'fornecedores';
			$campoId = 'cod_fornecedor';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('fornecedores');
      		}
		}


		
	}	