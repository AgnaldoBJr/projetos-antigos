
<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class ContaReceber extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
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

			$table = "clientes";
			$camposDeProjecao = "cod_cliente, nome";
			$data['dataCliente'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$data['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$sql = "SELECT contas_a_receber.*, clientes.nome as nome FROM `contas_a_receber`, `clientes` WHERE contas_a_receber.fk_cliente = clientes.cod_cliente ORDER by status, dt_recebimento";
			$data['dataTable'] = $this->Generic_model->justQuery($sql);

			$table = "centro_de_lucro";
			$data['dataCentro'] = $this->Generic_model->readAll($table);

			$table = "cat_conta_a_receber";
			$data['dataCategoria'] = $this->Generic_model->readAll($table);
			
			//var_dump($data['dataTable']); die;
			$this->load->view('financeiro/contas-a-receber/conta-receber-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$table = "clientes";
			$camposDeProjecao = "cod_cliente, nome";
			$data['dataCliente'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$data['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "cat_conta_a_receber";
			$camposDeProjecao = "cod_cat_conta_a_receber, nome";
			$data['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
		

			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-receber/conta-receber-create", $data);
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
				//var_dump($this->input->post()); die;
			$this->form_validation->set_rules('c-receber-descricao', 'Descrição', 'required|trim|min_length[5]|max_length[50]');
			//$this->form_validation->set_rules('c-receber-categoria', 'Categoria', 'required', array('required' => 'Escolha uma opção'));
			//$this->form_validation->set_rules('cliente', 'Cliente', 'required', array('required' => 'Escolha uma opção'));
			$this->form_validation->set_rules('c-receber-valor', 'Valor', 'required|trim');
			$this->form_validation->set_rules('c-receber-data', 'Data', 'required|trim');
			
			$this->form_validation->set_rules('c-receber-status', 'Status', 'required', array('required' => 'Escolha uma opção'));

			//$this->form_validation->set_rules('c-receber-conta', 'Conta', 'required', array('required' => 'Escolha uma opção'));
			
			if($this->input->post("c-receber-repetir") == '1'){		
				$this->form_validation->set_rules('c-receber-quantidade', 'Quantidade', 'required|trim|min_length[1]|max_length[2]');

				$this->form_validation->set_rules('c-receber-intervalo', 'Intervalo', 'required', array('required' => 'Escolha uma opção'));
			}
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
				
				//Se inserir a conta principal
				if($resultado){
					var_dump($resultado, $resultado['numero_repeticao']);
					//Se existir número de parcelas, adicionar número de descrição e faça a inserção de novas contas
					$cod = $resultado['cod_conta_a_receber'];
					$descricao = $resultado['descricao'];
					$resultado['cod_conta_a_receber'] = null;
					$num = (int) $resultado['numero_repeticao'];
					//var_dump($num); die;
					if($resultado['numero_repeticao'] > 1){
						for($i = 1; $i <  $num; $i++){
							echo "entrou no for";
							$resultado['descricao'] =  $descricao . "-" . ($i + 1);
							$resultado['fk_conta'] = $cod;
							$resultado['numero_repeticao'] = $i + 1;
							$resultado['status'] = "1";
							
							//var_dump($data, $resultado, $table, $campoId);
							$contas = $this->Generic_model->insert($table, $campoId, $resultado);
							var_dump($i);
						}
					}
					$this->session->set_flashdata('msg', 'Conta a receber salva com sucesso!');		
	      			redirect('contas-a-receber');
	      		}
	      		
	      	else{
	      			$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('contas-a-receber');
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

			$table = "cat_conta_a_receber";
			$camposDeProjecao = "cod_cat_conta_a_receber, nome";
			$resultado['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "clientes";
			$camposDeProjecao = "cod_cliente, nome";
			$resultado['dataCliente'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$resultado['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

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

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Conta a receber alterada com sucesso!');	
					redirect('contas-a-receber');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterada! Tente novamente!');
					redirect('contas-a-receber');
			}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_conta_a_receber');
			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Conta a receber excluída com sucesso!');	
					redirect('contas-a-receber');  		
		    } else{
					$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
					redirect('contas-a-receber');
			}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			//var_dump($data['c-receber-data'], formata_data_db($data['c-receber-data']) ); die;
			$contaReceber = array(
				'descricao' => $data['c-receber-descricao'],
				'fk_categoria' => $data['c-receber-categoria'],
				'fk_cliente' => $data['c-receber-cliente'],
				'fk_conta' => $data['c-receber-conta'],
				'valor' => formata_preco_db($data['c-receber-valor']),
				'dt_recebimento' =>  formata_data_db($data['c-receber-data']),
				'status'=> $data['c-receber-status'],
				'observacoes' => $data['c-receber-observacoes'],
				'repetir' => '0',
				'qtd_repeticao' => $data['c-receber-quantidade'],			
				'dt_cadastro' => date("Y-m-d H:i:s"),
				'fk_acesso' => $this->session->userdata('id'));
			return $contaReceber;
		}
		
		public function formatarData($data){
			$fragData = explode('/', $data);
			$newData = $fragData[2] . '-' . $fragData[1] . '-' . $fragData[0];
			//var_dump($newData);
			return $newData;
		}

		public function exibirData($data){
			$fragData = explode('-', $data);
			$newData = $fragData[2] . '/' . $fragData[1] . '/' . $fragData[0];
			//var_dump($newData);
			return $newData;
		}

		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************


		public function relatorios(){
			
			
			$data['form'] = $this->input->post();

			if($this->input->post('periodo') != ''){
				$date = explode(' - ', $this->input->post('periodo'));
				$data['form']['c-inicial'] = $date[0];
				$data['form']['c-final'] = $date[1];
			} else {
				$data['form']['c-inicial'] = '';
				$data['form']['c-final'] = '';
			}
			//var_dump( $this->input->post(), $data['form']['c-inicial'], $data['form']['c-final']); die;
			
			$groupBy = '';
			$orderBy = '';
			$campos = "contas_a_receber_view.*";
			$tables = "contas_a_receber_view";
			$where = " ";

			if($data['form']['c-inicial'] != ''){
				$where .= ' contas_a_receber_view.dt_cadastro >= "' . formata_data_db($data['form']['c-inicial']). '" AND ';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' contas_a_receber_view.dt_cadastro <= "' . formata_data_db($data['form']['c-final']). '" AND ';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'contas_a_receber_view.dt_cadastro, ';
				
			}


			if($data['form']['centro'] != ''){
				$where .= ' centro_lucro = "' . $data['form']['centro'] . '" AND ';
				$groupBy .= 'contas_a_receber_view.centro_lucro, '; 
				
			}

			if($data['form']['categoria'] != ''){
				$where .= ' fk_categoria = "' . $data['form']['categoria'] . '" AND ';
				$groupBy .= 'contas_a_receber_view.fk_categoria, '; 
				
			}

			if($data['form']['status'] != ''){
				$where .= ' status = "' . $data['form']['status'] . '" AND ';
				$groupBy .= 'status, ';

			}

			//Tirando o último AND e a última vírgula
			//if($where != 'propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano '){
				$where = substr($where, 0 , -4);
			//}
			if($groupBy != ''){
				$groupBy = substr($groupBy, 0 , -1);
			}

			//var_dump($data, $where, $groupBy, $orderBy, "-------------------------************************_______________________");
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'dt_cadastro');

			
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/contas-a-receber", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/contas-a-receber', $data, TRUE);
			$mpdf->AddPage('','','','','');
			$mpdf->SetHeader('CIMA SAÚDE');
			$mpdf->SetFooter('
				<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none; border-collapse:collapse;"> 
				<tr style="border: none;">

					<td width="50%" style="border: none;"><span style="font-weight: bold; font-style: italic;">www.cimasaude.com.br</span></td>

					<td width="50%" style="text-align: right; border: none;">{PAGENO}</td>

					</tr>
				</table>
			');
			$mpdf->writeHTML($html);
			$mpdf->Output('Relatorio-Contas-Receber'. date("Ymd").'.pdf' , 'D');
			 redirect('contas-a-receber');
		}

		public function status($status, $cod){
			$data = array('status' => $status, 'dt_real' => date('Y-m-d'));
			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';
			$id = $cod;

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('contas-a-receber');
      		}
		}

	}