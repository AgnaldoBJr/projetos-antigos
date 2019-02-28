<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class CentroLucro extends CI_Controller {

		
		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
		}

		//Método para carregar a view principal e carregar a lista na tabela
		public function index(){
			//Verifica sessão
			if($this->session->userdata('is_logged_in') != 1){
				$this->logout();
				redirect('acesso/login');
			}
			//---------------
			$this->load->view('commons/sidebar');
	

			$table = "centro_de_lucro";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('financeiro/centros/centro-lucro-crud', $data);
			
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método para realizar a insersão no banco de dados
		public function inserir(){
			$this->form_validation->set_rules('centro-lucro-nome', 'Nome', 'required|trim|min_length[5]');

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');

			$data['error_database'] = null;

			if($this->form_validation->run()){
				$data = $this->parseData($this->input->post());
				$table = 'centro_de_lucro';
				$campoId = 'cod_centro_de_lucro';
				
				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado == true){	
						$this->session->set_flashdata('msg', 'Centro de lucro salvo com sucesso!');	
						redirect('centro-de-lucro');  		
			    } else{
						$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
						redirect('centro-de-lucro');
				}
	      	}
	      	//var_dump($data); die;
	      	$this->load->view('commons/sidebar');
	      	$table = "centro_de_lucro";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('financeiro/centros/centro-lucro-crud', $data);

		}

		//Método para atualizar os dados no banco de dados
		public function atualizar(){
			$table = 'centro_de_lucro';
			$campoId = 'cod_centro_de_lucro';			
			$id = $this->input->post('cod_centro_de_lucro');
			$data = $this->input->post();
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
						$this->session->set_flashdata('msg', 'Centro de lucro alterado com sucesso!');	
						redirect('centro-de-lucro');  		
			    } else{
						$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
						redirect('centro-de-lucro');
				}
		}


		//Método para deletar o registro no banco de dados
		public function delete(){
			//var_dump($this->input->post('cod_centro_de_lucro')); die;
			$table = 'centro_de_lucro';
			$campoId = 'cod_centro_de_lucro';
			$data = $this->input->post('cod_centro_de_lucro');

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado == true){	
						$this->session->set_flashdata('msg', 'Centro de lucro excluído com sucesso!');	
						redirect('centro-de-lucro');  		
			    } else{
						$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
						redirect('centro-de-lucro');
				}
		}

		public function parseData($data){
		
			$parseData = array(
				'nome' => $data['centro-lucro-nome'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}
	}