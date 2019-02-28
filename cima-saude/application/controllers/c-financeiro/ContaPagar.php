<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class ContaPagar extends CI_Controller {

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

			$table = "fornecedores";
			$camposDeProjecao = "cod_fornecedor, nome";
			$data['dataFornecedor'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$data['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas_a_pagar";
			$data['dataTable'] = $this->Generic_model->readAll($table);

			$table = "centro_de_custo";
			$data['dataCentro'] = $this->Generic_model->readAll($table);

			$table = "cat_conta_a_pagar";
			$data['dataCategoria'] = $this->Generic_model->readAll($table);

			$this->load->view('financeiro/contas-a-pagar/conta-pagar-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function novo(){
			$table = "fornecedores";
			$camposDeProjecao = "cod_fornecedor, nome";
			$data['dataFornecedor'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$data['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "cat_conta_a_pagar";
			$camposDeProjecao = "cod_cat_conta_a_pagar, nome";
			$data['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			//var_dump($data);die;
			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-pagar/conta-pagar-create", $data);
		}

		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			$this->form_validation->set_rules('c-pagar-descricao', 'Descrição', 'required|trim|min_length[5]|max_length[50]');
			//$this->form_validation->set_rules('c-pagar-categoria', 'Categoria', 'required', array('required' => 'Escolha uma opção'));
			//$this->form_validation->set_rules('cliente', 'Cliente', 'required', array('required' => 'Escolha uma opção'));
			$this->form_validation->set_rules('c-pagar-valor', 'Valor', 'required|trim');
			$this->form_validation->set_rules('c-pagar-data', 'Data', 'required|trim');
			
			$this->form_validation->set_rules('c-pagar-status', 'Status', 'required', array('required' => 'Escolha uma opção'));

			//$this->form_validation->set_rules('c-pagar-conta', 'Conta', 'required', array('required' => 'Escolha uma opção'));

			if($this->input->post("c-pagar-repetir") == '1'){		
				$this->form_validation->set_rules('c-pagar-quantidade', 'Quantidade', 'required|trim|min_length[1]|max_length[2]');

				$this->form_validation->set_rules('c-pagar-intervalo', 'Intervalo', 'required', array('required' => 'Escolha uma opção'));
			}

			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
			$this->form_validation->set_message('valid_email', 'Digite um email válido!');
			$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');
		
		
			$data['error_database'] = null;

			if($this->form_validation->run()){

				
				$data = $this->parseData($this->input->post());
				$table = 'contas_a_pagar';
				$campoId = 'cod_conta_a_pagar';

				//var_dump($data); die;
				$resultado = $this->Generic_model->insert($table, $campoId, $data);

				if($resultado == true){	
						$this->session->set_flashdata('msg', 'Conta a pagar salva com sucesso!');	
						redirect('contas-a-pagar');  		
			    } else{
						$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
						redirect('contas-a-pagar');
				}
	      	}
	      	//var_dump($this->input->post()); die;
	      	
	      	$table = "cat_conta_a_pagar";
			$camposDeProjecao = "cod_cat_conta_a_pagar, nome";
			$data['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			//var_dump($data);die;
			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-pagar/conta-pagar-create", $data);

		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){


			$table = 'contas_a_pagar';
			$campoId = 'cod_conta_a_pagar';
			$id = $cod;
			$resultado = $this->Generic_model->readById($table, $campoId, $id);

			$table = "centro_de_custo";
			$camposDeProjecao = "cod_centro_de_custo, nome";
			$resultado['dataCentro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "cat_conta_a_pagar";
			$camposDeProjecao = "cod_cat_conta_a_pagar, nome";
			$resultado['dataCategoria'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "fornecedores";
			$camposDeProjecao = "cod_fornecedor, nome";
			$resultado['dataFornecedor'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			$table = "contas";
			$camposDeProjecao = "cod_conta, nome";
			$resultado['dataConta'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			//var_dump($resultado);die;

			$this->load->view('commons/sidebar');
			$this->load->view("financeiro/contas-a-pagar/conta-pagar-update", $resultado);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
		
			$data = $this->parseData($this->input->post());
			$table = 'contas_a_pagar';
			$campoId = 'cod_conta_a_pagar';
			$id = $this->input->post('cod_conta_a_pagar');

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Conta a pagar alterada com sucesso!');	
					redirect('contas-a-pagar');  		
		    } else{
					$this->session->set_flashdata('err', 'Não alterado! Tente novamente!');
					redirect('contas-a-pagar');
			}
	      	
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_conta_a_pagar');
			$table = 'contas_a_pagar';
			$campoId = 'cod_conta_a_pagar';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado == true){	
					$this->session->set_flashdata('msg', 'Conta a pagar excluída com sucesso!');	
					redirect('contas-a-pagar');  		
		    } else{
					$this->session->set_flashdata('err', 'Não excluído! Tente novamente!');
					redirect('contas-a-pagar');
			}
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){
			$contaPagar = array(
				'descricao' => $data['c-pagar-descricao'],
				'fk_categoria' => $data['c-pagar-categoria'],
				'fk_fornecedor' => $data['c-pagar-fornecedor'],
				'fk_conta' => $data['c-pagar-conta'],
				'valor' => formata_preco_db($data['c-pagar-valor']),
				'dt_pagamento' =>  formata_data_db($data['c-pagar-data']),
				'status'=> $data['c-pagar-status'],
				'fk_conta'=> $data['c-pagar-conta'],
				'observacoes' => $data['c-pagar-observacoes'],
				'repetir' => "0",
				'dt_cadastro' => date("Y-m-d H:i:s"),
				'fk_acesso' => $this->session->userdata('id'));

			return $contaPagar;
		}		


		public function formatarData($data){
			$fragData = explode('/', $data);
			$newData = $fragData[2] . '-' . $fragData[1] . '-' . $fragData[0];
			var_dump($newData);
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
			$campos = "contas_a_pagar_view.*";
			$tables = "contas_a_pagar_view";
			$where = " ";

			if($data['form']['c-inicial'] != ''){
				$where .= ' contas_a_pagar_view.dt_pagamento >= "' . formata_data_db($data['form']['c-inicial']). '" AND ';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' contas_a_pagar_view.dt_pagamento <= "' . formata_data_db($data['form']['c-final']). '" AND ';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'contas_a_pagar_view.dt_pagamento, ';
				
			}


			if($data['form']['centro'] != ''){
				$where .= ' fk_centro_custo = "' . $data['form']['centro'] . '" AND ';
				$groupBy .= 'contas_a_pagar_view.fk_centro_custo, '; 
				
			}

			if($data['form']['categoria'] != ''){
				$where .= ' fk_categoria = "' . $data['form']['categoria'] . '" AND ';
				$groupBy .= 'contas_a_pagar_view.fk_categoria, '; 
				
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
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'dt_pagamento');

			
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/contas-a-pagar", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/contas-a-pagar', $data, TRUE);
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
			$mpdf->Output('Relatorio-Contas-Pagar'. date("Ymd").'.pdf' , 'D');
			 redirect('contas-a-pagar');
		}

		public function status($status, $cod){
			$data = array('status' => $status, 'dt_real' => date('Y-m-d'));
			$table = 'contas_a_pagar';
			$campoId = 'cod_conta_a_pagar';
			$id = $cod;

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('contas-a-pagar');
      		}
		}
	}