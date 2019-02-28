<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Exame extends CI_Controller {

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
			
			$data['dataTable'] = $this->Generic_model->readAll('exames');

			
			
			//var_dump($data); die;
			$this->load->view('processos/exames/exames-crud', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  die;		
			$data = parseExame($this->input->post(), $this->session->userdata('id'), $this->session->userdata('is_logged_in'));
			$table = 'exames';
			$campoId = 'cod_exame';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Exame salvo com sucesso!');	
					redirect('exames');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('exames');
			}
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar(){
			//var_dump($this->input->post());  die;		
			$table = 'exames';
			$campoId = 'cod_exame';			
			$id = $this->input->post('cod_exame');
			$data = $this->input->post();
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Exame alterado com sucesso!');	
					redirect('exames');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('exames');
			}
			
		}


		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_exame');
			$table = 'exames';
			$campoId = 'cod_exame';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
					
				$this->session->set_flashdata('msg', 'Exame excluído com sucesso!');	
				redirect('exames');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
				redirect('exames');
			}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			$parseData = array(
				//'tipo' => $data['parceiro-tipo'],
				'nome' => $data['parceiro-nome'],
				'data_nasc' => $data['parceiro-data-nasc'],
				'cpf' => $data['parceiro-cpf'],
				'rg' => $data['parceiro-rg'],
				//'sexo' => $data['parceiro-sexo'],
				'estado_civil' => $data['parceiro-estado-civil'],
				//'razao_social' => $data['parceiro-razao-social'],
				//'nome_fantasia' => $data['parceiro-nome-fantasia'],
				//'cnpj' => $data['parceiro-cnpj'],
				'telefone' => $data['parceiro-telefone'],
				'celular' => $data['parceiro-celular'],
				//'celular_sec' => $data['parceiro-celular-sec'],
				'email' => $data['parceiro-email'],
				//'site' => $data['parceiro-site'],
				//'fk_endereco' => '1',
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}
	
	}	