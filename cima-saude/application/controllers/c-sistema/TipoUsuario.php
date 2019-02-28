<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class TipoUsuario extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('m-sistema/Tipo_model');
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


			$this->load->view('commons/sidebar');
			$table = 'tipo_usuarios';
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('sistema/tipos-de-usuario/tipos-de-usuario-read', $data);
		}

		//Método que renderiza a tela com o formulário de inserção
		public function novo(){
			$this->load->view('commons/sidebar');
			$table = 'permissoes';
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$data['size'] = count($data['dataTable']);
			$this->load->view("sistema/tipos-de-usuario/tipos-de-usuario-create", $data);
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());
			
			//Validar os campos
			$this->form_validation->set_rules('tipo-nome', 'Nome', 'required|trim|min_length[5]');

			//Mensagens de Validação
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			
			$data['error_database'] = null;
			if($this->form_validation->run()){
				//Formar strings de parâmetros de cada permissão
				$p = $this->tratarPermissoes($this->input->post());
				//var_dump($p);  die;
				
				//Tratar dados da inserção do tipo de usuário
				$data = $this->parseData($this->input->post());


				//var_dump($this->input->post(), $data); die;
				
				$resultado = $this->Tipo_model->insert($data, $p);

				if($resultado == true){
					//var_dump("Ok"); die;
	      			//echo "<p class='js-notify btn btn-sm btn-success'>OK</p>"; die;
	      			$this->session->set_flashdata('msg', 'Cadastrado com sucesso!');
	      			redirect('tipos-de-usuario/novo');
	      			
	      		}
	      		else{
					$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
	      			redirect('tipos-de-usuario/novo');
				}
	      	}

	      	$this->load->view('commons/sidebar');
			$table = 'permissoes';
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$data['size'] = count($data['dataTable']); 
			$this->load->view("sistema/tipos-de-usuario/tipos-de-usuario-create", $data);
		}



		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			$id = $cod;
			
			$data = $this->Tipo_model->readDataAndPermission($id);

			$this->load->view('commons/sidebar');
			$table = 'permissoes';
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$data['size'] = count($data['dataTable']);
			//var_dump($data['permission']['0'] , substr($data['permission']['0']['parametros'], -2, 3));

			//var_dump($data['dataTable']['1']); die;
			for($i = 0; $i < sizeof($data['dataTable']); $i++) {
				//var_dump(substr($data['permission'][(String)$i]['parametros'], 0, 1)); die;

				$data['p'][(String) $i] = array(
					'cod_permissao' => $data['permission'][(String)$i]['fk_permissao'],
					'nome' => $data['dataTable'][(String) $i]['nome'],
					'insert' => (substr($data['permission'][(String)$i]['parametros'], 0, 1) == 1) ? '1' : '0',
					'read' => (substr($data['permission'][(String)$i]['parametros'], 1, 1) == 1) ? '1' : '0',
					'update' => (substr($data['permission'][(String)$i]['parametros'], 2, 1) == 1) ? '1' : '0',
					'delete' => (substr($data['permission'][(String)$i]['parametros'], 3, 1) == 1) ? '1' : '0'
					);
				//if($i = 2)
					//var_dump($data['p']['0']); 
			} //die;
			//var_dump($data); die;
			

			$this->load->view('sistema/tipos-de-usuario/tipos-de-usuario-update', $data);
			//$this->load->view("cadastros/clientes/clientes-update", $resultado);
			
		}



		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			//Validar os campos
			$this->form_validation->set_rules('tipo-nome', 'Nome', 'required|trim|min_length[5]');

			//Mensagens de Validação
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			
			$data['error_database'] = null;
			if($this->form_validation->run()){
				$data = $this->parseDataUpdate($this->input->post());
				//var_dump($this->input->post()); die;
				$p = $this->tratarPermissoes($this->input->post());
				//var_dump($p);  die;
				$id = $this->input->post('cod_tipo_usuario');

				$resultado = $this->Tipo_model->update($id, $data, $p);

					if($resultado == true){
						//var_dump("Ok"); die;
		      			//echo "<p class='js-notify btn btn-sm btn-success'>OK</p>"; die;
		      			$this->session->set_flashdata('msg', 'Alterado com sucesso!');
		      			redirect('tipos-de-usuario');
		      			
		      		}
		      		else{
						$this->session->set_flashdata('msg', 'Não cadastrado! Tente novamente!');
		      			redirect('tipos-de-usuario/novo');
					}
			}
	    }
		




		//Método para deletar um registro
		public function delete(){
			//var_dump($this->input->post());
			//die;
			
			$table = 'permissoes';
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$size= count($data['dataTable']);

			for($i = 1; $i <= $size; $i++){
				$data = $this->input->post('cod_tipo_usuario');
				$table = 'user_permission';
				$campoId_tipo = 'fk_tipo_usuario';
				$campoId_permission = 'fk_permissao';

				$resultado = $this->Tipo_model->deletePermissions($table, $campoId_tipo, $campoId_permission, $data, $i);
			}

			$data = $this->input->post('cod_tipo_usuario');
			$table = 'tipo_usuarios';
			$campoId = 'cod_tipo_usuario';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);


			if($resultado){
				$this->session->set_flashdata('msg', 'Excluído com sucesso!');
      			redirect('tipos-de-usuario');
      		}
		}


		public function tratarPermissoes($data){
			$p = array();
			for($i = 1; $i<= $data["size"]; $i++){
				
				$s = "i-" . $i;
				if($this->input->post('i-' . $i) != null)
					$p[$i] = '1';
				else
					$p[$i] = '0';

				if($this->input->post('r-' . $i) != null)
					$p[$i] .= '1';
				else
					$p[$i] .= '0';

				if($this->input->post('u-' . $i) != null)
					$p[$i] .= '1';
				else
					$p[$i] .= '0';

				if($this->input->post('d-' . $i) != null)
					$p[$i] .= '1';
				else
					$p[$i] .= '0';

			}
			return $p;
		}

		public function parseData($data){

			$parseData = array(
				'nome' => $data['tipo-nome'],
				'descricao' => $data['tipo-descricao'],
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}

		public function parseDataUpdate($data){

			$parseData = array(
				'nome' => $data['tipo-nome'],
				'descricao' => $data['tipo-descricao']);

			return $parseData;
		}
		
	}