<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class PosAtendimento extends CI_Controller {

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
			
			$sql = 'SELECT beneficiarios.*, guias_atendimento.* , parceiros.nome as nome_realizador FROM beneficiarios, guias_atendimento, parceiros WHERE beneficiarios.tab = guias_atendimento.fk_tabela AND beneficiarios.cod = guias_atendimento.fk_paciente AND guias_atendimento.fk_realizador = parceiros.cod_parceiro';
			$data['dataTable'] = $this->Generic_model->justQuery($sql);

			$table = "parceiros";
			$camposDeProjecao = "cod_parceiro, nome";
			$data['dataParceiro'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);

			//var_dump($data); die;
			$this->load->view('processos/pos-atendimento/pos-read', $data);

		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}

		//Método que renderiza a tela
		public function novo(){
			
			//$campos = "propostas.*, clientes.nome as cliente_nome, clientes.email as cliente_email, planos.nome as plano_nome";
			//$tables = "propostas, clientes, planos";
			//$where = "propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano";
			//$data['dataTable'] = $this->Generic_model->readAndProjectionManyTables($campos, $tables, $where);
			$data['dataExame'] = $this->Generic_model->readAll('exames');

			$data['dataPacientes'] = $this->Generic_model->readAll('pacientes');
			//var_dump($data['dataPacientes']); die;

			$table = "parceiros";
			$data['dataParceiros'] = $this->Generic_model->readAll($table);

			$this->load->view('commons/sidebar');
			$this->load->view("processos/guias/guias-create", $data);
		}
		
		//Método que salva os dados a partir de um novo formulário
		public function salvar(){
			//var_dump($this->input->post());  		
			$data = $this->input->post();
			//var_dump($data['pagamento']);
			//Inserir os dados da Guia de Atendimento
			//Inserir valor total da guia
			$guia_servicos = '';
			$data['valor'] = 0;
			$k = 0;

			$servicos = $this->Generic_model->readAll('servicos');
			for($i = 1; $i <= count($servicos); $i++){
				if(array_key_exists('c-' . $i, $data)){//i = codigo do servico
					foreach ($servicos as $servico) {
						if($servico['cod_servico'] == $i){
							$data['valor'] += ($data['pagamento'] == 'c') ? $servico['valor_cima'] : servico['valor_recibo'];

							$guia_servicos[$k] = $i;
							$k++; 
						}
					}
				}
			}

			//var_dump($data['valor'], $guia_servico);  
			//die;
			//Inserir o codigo do dependente e a tabela
			$codigos = explode('-', $this->input->post('paciente'));
			$data['fk_paciente'] = $codigos[0];
			$data['fk_tabela'] = $codigos[1];

			//var_dump($codigos);
			$data = parseGuia($data, $this->session->userdata('id'));
			//var_dump($data); die;
			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			//var_dump($data); die;
			$resultado = $this->Generic_model->insert($table, $campoId, $data);


			//Inserir os servicos
			//var_dump($resultado); die;
			foreach ($guia_servicos as $guia_servico) {

				$dados = array('fk_guia' => $resultado['cod_guia'],
							   'fk_servico' => $guia_servico);
				//var_dump($guia_servico, $dados); die;
				$this->Generic_model->insert('guias_servico', 'cod_guia_servico', $dados);

			}

      		if($resultado == true){	
					$this->session->set_flashdata('msg', 'Guia salva com sucesso!');	
					redirect('guias');  		
		    } else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('guias');
			}
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar(){
		
			
			$data = $this->input->post();
			$data['aval_fk_acesso'] = $this->session->userdata('id');
			$data['aval_dt_cadastro'] = date('Y-m-d H:m');
			//var_dump($data); die;

			$table = 'guias_atendimento';
			$campoId = 'cod_guia';
			$id = $data['cod_guia'];
			
			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('pos-atendimento');
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
			$data = $this->input->post('cod_parceiro');
			$table = 'parceiros';
			$campoId = 'cod_parceiro';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('parceiros');
      		}
		}


		//Método que carrega uma view de formulário para ser vizualizado
		public function visualizar($cod){
			$sql = 'SELECT pacientes.*, guias_atendimento.* , parceiros.nome as parceiro, parceiros.tipo as tipo FROM pacientes, guias_atendimento, parceiros WHERE pacientes.tabela = guias_atendimento.fk_tabela AND pacientes.codigo = guias_atendimento.fk_paciente AND guias_atendimento.fk_realizador = parceiros.cod_parceiro AND guias_atendimento.cod_guia = ' . $cod;
			$resultado = $this->Generic_model->justQuery($sql);
			$data['guia'] = $resultado[0];
			//var_dump($data['guia']); die;

			$table = convertTabelas($data['guia']['tabela']);
			$campoId = convertId($data['guia']['tabela']);

			//var_dump($table, $campoId); die;
			$cliente = $this->Generic_model->readById($table, $campoId, $data['guia']['codigo']);
			//var_dump($data['guia'], $cliente['cod_cliente']); die;
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $cliente['cod_cliente']);

			$data['servicos'] = $this->Generic_model->readAllWhere('servicos_guias', 'fk_guia', $data['guia']['cod_guia']);
			//var_dump($data['guia']);
			//var_dump($data['servicos']); die;
			
			


			$this->load->view('commons/sidebar');
			$this->load->view("processos/guias/guias-view", $data);

		}


		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************


		public function relatorios(){
			$data['form'] = $this->input->post();
			//var_dump($data['form']); die;
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
			$campos = "guias_atendimento.*, parceiros.nome as parceiro, beneficiarios.nome as beneficiario";
			$tables = " guias_atendimento, parceiros, beneficiarios ";
			$where = " guias_atendimento.fk_realizador = parceiros.cod_parceiro AND guias_atendimento.fk_paciente = beneficiarios.cod AND guias_atendimento.fk_tabela = beneficiarios.tab AND";

			if($data['form']['c-inicial'] != ''){
				$where .= ' beneficiario_guias_parceiro_view.aval_dt_cadastro >= "' . formata_data_db($data['form']['c-inicial']). '" AND ';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' beneficiario_guias_parceiro_view.aval_dt_cadastro <= "' . formata_data_db($data['form']['c-final']). '" AND ';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'beneficiario_guias_parceiro_view.aval_dt_cadastro, ';
				
			}


			if($data['form']['parceiro'] != ''){
				$where .= ' fk_realizador = "' . $data['form']['parceiro'] . '" AND ';
				$groupBy .= 'beneficiario_guias_parceiro_view.fk_realizador, '; 
				
			}

			if($data['form']['status'] != ''){
				$where .= ' avaliacao = "' . $data['form']['status'] . '" AND ';
				$groupBy .= 'avaliacao, ';

			}

			//Tirando o último AND e a última vírgula
			//if($where != 'propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano '){
				$where = substr($where, 0 , -4);
			//}
			if($groupBy != ''){
				$groupBy = substr($groupBy, 0 , -1);
			}

			//var_dump($data, $where, $groupBy, $orderBy, "-------------------------************************_______________________");
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'aval_dt_cadastro');

			
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/guia-pos", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/guia-pos', $data, TRUE);
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

	
	}	