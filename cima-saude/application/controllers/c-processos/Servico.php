<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Servico extends CI_Controller {

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
			$sql = 'SELECT servicos.*, parceiros.nome as parceiro, exames.nome as exame FROM servicos left join parceiros on servicos.fk_parceiro = parceiros.cod_parceiro left join exames on servicos.fk_exame = exames.cod_exame';
			$data['dataTable'] = $this->Generic_model->justQuery($sql);

			
			$table = "parceiros";
			$data['dataParceiros'] = $this->Generic_model->readAll($table);
			
			$table = "exames";
			$data['dataExames'] = $this->Generic_model->readAll($table);
			

			//var_dump($data); die;
			$this->load->view('processos/servicos/servicos-crud', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  die;		
			$data = parseServico($this->input->post(), $this->session->userdata('id'));
			$table = 'servicos';
			$campoId = 'cod_servico';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Serviço salvo com sucesso!');	
					redirect('servicos');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('servicos');
			}
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			//var_dump($this->input->post());  die;		
			$table = 'servicos';
			$campoId = 'cod_servico';			
			$id = $this->input->post('cod_servico');
			$data = $this->input->post();
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Serviço alterado com sucesso!');	
					redirect('servicos');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('servicos');
			}
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'parceiros';
			$campoId = 'cod_parceiro';
			$id = $this->input->post('cod_parceiro');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('parceiros');
      		}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_servico');
			$table = 'servicos';
			$campoId = 'cod_servico';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
					
				$this->session->set_flashdata('msg', 'Serviço excluído com sucesso!');	
				redirect('servicos');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
				redirect('servicos');
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

		public function todos(){
			$sql = 'SELECT servicos.*, parceiros.nome as parceiro, exames.nome as exame FROM servicos left join parceiros on servicos.fk_parceiro = parceiros.cod_parceiro left join exames on servicos.fk_exame = exames.cod_exame';
			$data = $this->Generic_model->justQuery($sql);

			echo json_encode($data);
		}
	
		public function byParceiro($cod){
				$sql = 'SELECT servicos.*, parceiros.nome as parceiro, exames.nome as exame FROM servicos left join parceiros on servicos.fk_parceiro = parceiros.cod_parceiro left join exames on servicos.fk_exame = exames.cod_exame WHERE	fk_parceiro = ' . $cod;
				$data = $this->Generic_model->justQuery($sql);

				echo json_encode($data);
			}
	}	