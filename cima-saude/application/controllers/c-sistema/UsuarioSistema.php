<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class UsuarioSistema extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
		}



		public function index(){
			//Verifica sessão
			if($this->session->userdata('is_logged_in') != 1){
				$this->logout();
				redirect('acesso/login');
			}
			//---------------
			//Verifica a permissão novamente

			//---------------

			//echo "Você está em Usuarios do Sistema"; die;
			$this->load->view('commons/sidebar');

			$campos = 'acesso.* , tipo_usuarios.nome as nome ';
			$tables = 'acesso, tipo_usuarios ';
			$where = 'acesso.fk_tipo_usuario = tipo_usuarios.cod_tipo_usuario';
			$data['dataTable'] = $this->Generic_model->readAndProjectionManyTables($campos, $tables, $where);
			$this->load->view('sistema/usuarios-do-sistema/usuarios-do-sistema-read', $data);
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}

		//Método que renderiza a tela com o formulário de inserção
		public function novo(){
			$table = "tipo_usuarios";
			$camposDeProjecao = "cod_tipo_usuario, nome";
			$data['tipo'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$this->load->view('commons/sidebar');
			$this->load->view("sistema/usuarios-do-sistema/usuarios-do-sistema-create", $data);
		}
		
		//Método para realizar a insersão no banco de dados
		public function salvar(){
			$this->form_validation->set_rules('username', 'Nome', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|min_length[5]');
			$this->form_validation->set_rules('senha', 'Senha', 'required|md5|trim|min_length[6]');
			$this->form_validation->set_rules('c_senha', 'Confirmar Senha', 'required|md5|trim|min_length[6]|matches[senha]');
			$this->form_validation->set_rules('tipo', 'Tipo de Usuário', 'required', array('required' => 'Escolha uma opção'));

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
			$this->form_validation->set_message('valid_email', 'Digite um email válido!');
			$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');


			$data['error_database'] = null;

			if($this->form_validation->run()){

				$data = $this->parseData($this->input->post());
				$table = 'acesso';
				$campoId = 'cod_acesso';
				//var_dump($data); die;
				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado == true){
					//var_dump("Ok"); die;
	      			//echo "<p class='js-notify btn btn-sm btn-success'>OK</p>"; die;
	      			$this->session->set_flashdata('msg', 'Cadastrado com sucesso!');
	      			redirect('usuarios-do-sistema/novo');
	      			
	      		}
	      		else{
					$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
	      			redirect('usuarios-do-sistema/novo');
				}
	      	}
	      	//var_dump($this->input->post()); die;
			
			$table = "tipo_usuarios";
			$camposDeProjecao = "cod_tipo_usuario, nome";
			$data['tipo'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$this->load->view('commons/sidebar');
			$this->load->view("sistema/usuarios-do-sistema/usuarios-do-sistema-create", $data);
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			$table = 'acesso';
			$campoId = 'cod_acesso';
			$id = $cod;
			
			$data['dados'] = $this->Generic_model->readById($table, $campoId, $id);

			$table = "tipo_usuarios";
			$camposDeProjecao = "cod_tipo_usuario, nome";
			$data['tipo'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$this->load->view('commons/sidebar');
			$this->load->view("sistema/usuarios-do-sistema/usuarios-do-sistema-update", $data);
			
		}



		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			//Validar os campos
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|min_length[5]');
			$this->form_validation->set_rules('senha', 'Senha', 'required||trim|md5');
			$this->form_validation->set_rules('c_senha', 'Confirmar Senha', 'required||trim|md5|matches[senha]');
			$this->form_validation->set_rules('tipo', 'Tipo de Usuário', 'required', array('required' => 'Escolha uma opção'));

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
			$this->form_validation->set_message('valid_email', 'Digite um email válido!');
			$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');


			if($this->form_validation->run()){
				
				$data = $this->parseData($this->input->post());
				$table = 'acesso';
				$campoId = 'cod_acesso';
				$id = $this->input->post('cod_acesso');

				$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

		
				if($resultado == true){
					//var_dump("Ok"); die;
	      			//echo "<p class='js-notify btn btn-sm btn-success'>OK</p>"; die;
	      			$this->session->set_flashdata('msg', 'Alterado com sucesso!');
	      			redirect('usuarios-do-sistema');
	      			
	      		}
	      		else{
					$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
	      			redirect('usuarios-do-sistema');
				}
			}
	    }


		//Método para deletar um registro
		public function delete(){
			//var_dump($this->input->post());
			//die;
			$data = $this->input->post('cod_acesso');
			$table = 'acesso';
			$campoId = 'cod_acesso';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);


			if($resultado){
				$this->session->set_flashdata('msg', 'Excluído com sucesso!');
      			redirect('usuarios-do-sistema');
      		}
		}

		public function parseData($data){
		
			$parseData = array(
				'username' => $data['username'],
				'email' => $data['email'],
				'senha' => $data['senha'],
				'fk_tipo_usuario' => $data['tipo'],
				'fk_tabela' => 0,
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}

		

	}