<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class CategoriaContaReceber extends CI_Controller {

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
			$camposDeProjecao = "cod_centro_de_lucro, nome";
			$data['dataCentro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$campos = "cat_conta_a_receber.*, centro_de_lucro.nome as centro_de_lucro_nome";
			$tables = "cat_conta_a_receber, centro_de_lucro";
			$where = "cat_conta_a_receber.fk_centro_de_lucro = centro_de_lucro.cod_centro_de_lucro";
			$data['dataTable'] = $this->Generic_model->readAndProjectionManyTables($campos, $tables, $where);
			$this->load->view('financeiro/categorias/categoria-conta-receber-crud', $data);
			
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método para realizar a insersão no banco de dados
		public function inserir(){
           	$this->form_validation->set_rules('categoria-nome', 'Nome', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('categoria-centro-lucro', 'Centro de Lucro', 'required', array('required' => 'Escolha uma opção'));

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');

			$data['error_database'] = null;

			if($this->form_validation->run()){

				$data = $this->parseData($this->input->post());
				$table = 'cat_conta_a_receber';
				$campoId = 'cod_cat_conta_a_receber';
				//var_dump($data); die;
				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado == true){	
						$this->session->set_flashdata('msg', 'Categoria salva com sucesso!');	
						redirect('categorias-contas-a-receber');  		
			    } else{
						$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
						redirect('categorias-contas-a-receber');
				}
	      	}
	      	//var_dump($this->input->post()); die;
	      	$this->load->view('commons/sidebar');
			
			$table = "centro_de_lucro";
			$camposDeProjecao = "cod_centro_de_lucro, nome";
			$data['dataCentro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "cat_conta_a_receber";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('financeiro/categorias/categoria-conta-receber-crud', $data);
		}

		//Método para atualizar os dados no banco de dados
		public function atualizar(){

			
			$table = 'cat_conta_a_receber';
			$campoId = 'cod_cat_conta_a_receber';			
			$id = $this->input->post('cod_cat_conta_a_receber');
			$data = $this->input->post();
			//var_dump($data);die;
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Categoria alterado com sucesso!');	
					redirect('categorias-contas-a-receber');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('categorias-contas-a-receber');
			}
		}


		//Método para deletar o registro no banco de dados
		public function delete(){
			$table = 'cat_conta_a_receber';
			$campoId = 'cod_cat_conta_a_receber';
			$data = $this->input->post('cod_cat_conta_a_receber');

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Categoria excluído com sucesso!');	
					redirect('categorias-contas-a-receber');  		
		    } else{
					$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
					redirect('categorias-contas-a-receber');
			}
		}

		public function parseData($data){
		
			$parseData = array(
				'nome' => $data['categoria-nome'],
				'fk_centro_de_lucro' => $data['categoria-centro-lucro'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}

	}