<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Acesso extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
		}

		public function index(){

			//Verifica sessão
			//var_dump($this->session->userdata('is_logged_in')); die;
			if($this->session->userdata('is_logged_in') == 1){
				//$this->logout();
				redirect('dashboard');
			} else if($this->session->userdata('is_logged_in') == 2){
				//$this->logout();
				redirect('atendimento/beneficiarios');
			} else if($this->session->userdata('is_logged_in') != 1 && $this->session->userdata('is_logged_in') != 2){
				$this->logout();
				redirect('acesso/login');
			}
			//---------------

			
			//$this->load->view('commons/sidebar');
			//$this->load->view('commons/header');
			//$this->load->view('commons/footer');
			
		}

		//Description function: Função para validação de login: valida formulário e se há usuário no banco de dados, carrega a view 'commons/loginBusiness'
		// Created by Probtools Development
		// Author: Agnaldo Burgo Junior
		// Date: 27/02/2017
		public function login(){
			//$this->session->sess_destroy();
			$this->form_validation->set_rules('email', 'Usuário', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('senha', 'Senha', 'required|md5|trim');
			
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');

			$data['error_database'] = null;

			if($this->form_validation->run()){
				$dataLogin = $this->input->post();
      			$res = $this->Acesso_model->readEmailDeAcesso($dataLogin);
      			//var_dump($res[0]->fk_tipo_usuario); die;
      			if(!$res){
      				$data['error_database'] = 'Senha ou usuário inválidos';
      			}
      			else{
      				//validação
      				if ($dataLogin['senha'] != $res[0]->senha){
      						$data['error_database'] = 'Senha ou usuário inválidos';
      					}
      					else {
      						//Validação de login com sucesso
    						//Carregar as permissões de acesso
      						$permission = $this->Acesso_model->loadPermissoes($res[0]->cod_acesso, $res[0]->fk_tipo_usuario);

      						//Código para acessar os parâmetros de uma permissão, sendo um vetor, a permissão 1 está no índice [0]
      						//var_dump($permission[0]['parametros']); 
      						
      						//Início de sessão e redirect
      						if($res[0]->fk_tipo_usuario == '0'){
      							$dataSession = array (
      								'id' => $res[0]->cod_acesso,
      								'nome' => $res[0]->username,
      								'email'=> $res[0]->email,
      								'tipo_acesso' => $res[0]->fk_tipo_usuario,
      								'permission' => $permission,     								
      								'is_logged_in' => 2
      							);      							
      						} else {
      							$dataSession = array (
      								'id' => $res[0]->cod_acesso,
      								'nome' => $res[0]->username,
      								'email'=> $res[0]->email,
      								'tipo_acesso' => $res[0]->fk_tipo_usuario,
      								'permission' => $permission,     								
      								'is_logged_in' => 1
      							);
      						}
      						
      						//var_dump($dataSession['is_logged_in']); die;
      						$this->session->set_userdata($dataSession); 
							
							//die;
      						
      						//teste de como verificar a permissão
      						//var_dump($this->session->userdata('permission')[0]['parametros']); die;

							redirect('acesso');
      					}
      				}
      			}

        	$this->load->view('commons/login', $data);
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		public function inserir(){
			$data = $this->input->post();
			$table = 'teste';
			$campoId = 'cod_teste';

			$resultado = $this->Generic_model->insert($table, $campoId, $data);

			if($resultado){
      			redirect('acesso');
      		}
		}

		public function delete(){
			$data = $this->input->post('cod_teste');
			$table = 'teste';
			$campoId = 'cod_teste';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('acesso');
      		}
		}

		public function atualizar(){
			
			$table = 'teste';
			$campoId = 'cod_teste';
			$id = $this->input->post('cod_teste');
			$data = $this->input->post();
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('acesso');
      		}
		}
	}