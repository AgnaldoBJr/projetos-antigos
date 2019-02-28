
<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class ContaReceber extends CI_Controller {

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
			$table = "contas_a_receber";
			$data['dataTable'] = $this->Generic_model->readAll($table);
			$this->load->view('financeiro/contas-a-receber/conta-receber-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){

			$table = "centro_de_lucro";
			$camposDeProjecao = "cod_centro_de_lucro, nome";
			$data['dataCentro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "cat_conta_a_receber";
			$camposDeProjecao = "cod_cat_conta_a_receber, nome";
			$data['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
		
			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-receber/conta-receber-create", $data);
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
				
			$this->form_validation->set_rules('c-receber-descricao', 'Descrição', 'required|trim|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('c-receber-categoria', 'Categoria', 'required', array('required' => 'Escolha uma opção'));
			//$this->form_validation->set_rules('cliente', 'Cliente', 'required', array('required' => 'Escolha uma opção'));
			$this->form_validation->set_rules('c-receber-valor', 'Valor', 'required|trim');
			$this->form_validation->set_rules('c-receber-data', 'Data', 'required|trim');
			
			$this->form_validation->set_rules('c-receber-status', 'Status', 'required', array('required' => 'Escolha uma opção'));

			$this->form_validation->set_rules('c-receber-conta', 'Conta', 'required', array('required' => 'Escolha uma opção'));
						
			//$this->form_validation->set_rules('c-receber-quantidade', 'Quantidade', 'required|trim|min_length[1]|max_length[2]');

			//$this->form_validation->set_rules('c-receber-intervalo', 'Intervalo', 'required', array('required' => 'Escolha uma opção'));

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
			$this->form_validation->set_message('valid_email', 'Digite um email válido!');
			$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');
		
		
			$data['error_database'] = null;

			if($this->form_validation->run()){
				$data = $this->parseData($this->input->post());
				$table = 'contas_a_receber';
				$campoId = 'cod_conta_a_receber';

				//var_dump($data); die;
				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado){
	      			redirect('contas-a-receber');
	      		}
	      	else{
					$data['error_database'] = 'Não cadastrado! Tente novamente';
				}
	      	}
	      	//var_dump($this->input->post()); die;
	      	
	      	$table = "cat_conta_a_receber";
			$camposDeProjecao = "cod_cat_conta_a_receber, nome";
			$data['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			//var_dump($data);die;
			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-receber/conta-receber-create", $data);

		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
		

			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';
			$id = $cod;
			
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$table = "centro_de_lucro";
			$camposDeProjecao = "cod_centro_de_lucro, nome";
			$resultado['dataCentro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "cat_conta_a_receber";
			$camposDeProjecao = "cod_cat_conta_a_receber, nome";
			$resultado['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-receber/conta-receber-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';
			$id = $this->input->post('cod_conta_a_receber');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('contas-a-receber');
      		}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_conta_a_receber');
			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('contas-a-receber');
      		}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			$contaReceber = array(
				'descricao' => $data['c-receber-descricao'],
				'fk_categoria' => $data['c-receber-categoria'],
				'valor' => $data['c-receber-valor'],
				'dt_recebimento' =>  date("Y-M-D"),
				'status'=> "1",
				'fk_conta'=> $data['c-receber-conta'],
				'observacoes' => $data['c-receber-observacoes'],
				'repetir' => "0",
				'dt_cadastro' => date("Y-m-d H:i:s"),
				'fk_acesso' => $this->session->userdata('id'));
			return $contaReceber;
		}
		

	}
