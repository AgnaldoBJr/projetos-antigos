<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Especialidade extends CI_Controller {

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
			
			$data['dataTable'] = $this->Generic_model->readAll('especialidades');

			
			
			//var_dump($data); die;
			$this->load->view('outros/especialidades/especialidades-crud', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  die;		
			$data = parseEspecialidade($this->input->post(), $this->session->userdata('id'));
			$table = 'especialidades';
			$campoId = 'cod_especialidade';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Especialidade salva com sucesso!');	
					redirect('especialidades');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('especialidades');
			}
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar(){
			//var_dump($this->input->post());  die;		
			$table = 'especialidades';
			$campoId = 'cod_especialidade';			
			$id = $this->input->post('cod_especialidade');
			$data = $this->input->post();
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Especialidade alterada com sucesso!');	
					redirect('especialidades');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('especialidades');
			}
			
		}


		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_especialidade');
			$table = 'especialidades';
			$campoId = 'cod_especialidade';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
					
				$this->session->set_flashdata('msg', 'Especialidade excluída com sucesso!');	
				redirect('especialidades');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
				redirect('especialidades');
			}
		}
	
	}	