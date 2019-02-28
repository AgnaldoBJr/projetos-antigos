<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Contratos extends CI_Controller {

		
		function __construct(){
			parent::__construct();

			$this->load->model('Generic_model');
			$this->load->helper('funcoes');
			$this->load->helper('parse');
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

			$campos = "contratos.*, clientes.nome as cliente_nome, clientes.email as cliente_email, planos.nome as plano_nome";
			$tables = "contratos, clientes, planos";
			$where = "contratos.fk_cliente = clientes.cod_cliente and contratos.fk_plano = planos.cod_plano";
			$data['dataTable'] = $this->Generic_model->readAndProjectionManyTables($campos, $tables, $where);

			//var_dump($data['dataTable']);die;
			$table = "planos";
			$data['dataPlanos'] = $this->Generic_model->readAll($table);

			$table = "contas_a_receber";
			$data['contas'] = $this->Generic_model->readAll($table);
			//var_dump($data['dataTable'], $data['contas']); die;

			$this->load->view('contratos/contratos/contratos-read', $data);
			
		}

		//Método que carrega uma view de formulário para ser vizualizado
		public function visualizar($cod){
		
			$data['contrato'] = $this->Generic_model->readById('contratos', 'cod_contrato', $cod);
			$data['contrato']['dt_contratacao'] = formata_data_br($data['contrato']['dt_contratacao']);
			$data['contrato']['dt_vencimento'] = formata_data_br($data['contrato']['dt_vencimento']);

			$data['contrato']['modo']= forma($data['contrato']['pag_modo_pagamento']);
			$data['contrato']['pag_subtotal']= 'R$ ' . formata_preco($data['contrato']['pag_subtotal']);
			$data['contrato']['pag_total']= 'R$ ' . formata_preco($data['contrato']['pag_total']);
			$data['contrato']['pag_desconto']= ($data['contrato']['pag_desconto'] != "Não aplicado") ? $data['contrato']['pag_desconto'] . '%' : $data['contrato']['pag_desconto'];
			$data['contrato']['pag_valor_parcelas']= 'R$ ' . formata_preco($data['contrato']['pag_valor_parcelas']);


			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['contrato']['fk_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['contrato']['fk_plano']);

			if($data['plano']['dependentes'] == "1")
				$data['dependentes'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_dependentes', 'fk_proposta = ' . $data['contrato']['cod_proposta']);

			if($data['plano']['agregados'] == "1")
				$data['agregados'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_agregados', 'fk_proposta = ' . $data['contrato']['cod_proposta']);

			if($data['plano']['colaboradores'] == "1")
				$data['colaboradores'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_colaboradores', 'fk_proposta = ' . $data['contrato']['cod_proposta']);


			$data['contas'] = $this->Generic_model->readAndProjectionOrderBy("contas_a_receber.*", "contas_a_receber", "fk_contrato = " . $data['contrato']['cod_contrato'], 'dt_recebimento');


			//var_dump($data); die;
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/contratos/contratos-view", $data);

		}

		//Método que carrega uma view de formulário para ser vizualizado
		public function novoPDF($cod){
			$data['contrato'] = $this->Generic_model->readById('contratos', 'cod_contrato', $cod);

			$data['contrato']['modo']= forma($data['contrato']['pag_modo_pagamento']);

			$data['texto'] = "";
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['contrato']['fk_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['contrato']['fk_plano']);

			if($data['plano']['dependentes'] == "1")
				$data['dependentes'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_dependentes', 'fk_proposta = ' . $data['contrato']['cod_proposta']);

			if($data['plano']['agregados'] == "1")
				$data['agregados'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_agregados', 'fk_proposta = ' . $data['contrato']['cod_proposta']);

			if($data['plano']['colaboradores'] == "1")
				$data['colaboradores'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_colaboradores', 'fk_proposta = ' . $data['contrato']['cod_proposta']);

			$data['contas'] = $this->Generic_model->readAndProjectionOrderBy("contas_a_receber.*", "contas_a_receber", "fk_contrato = " . $data['contrato']['cod_contrato'], 'dt_recebimento');

			//echo "novoPDF";
			//var_dump($data); die;

			//var_dump($data['dependentes']); die;
				//var_dump($data); die;
				// Instancia a classe mPDF
				$mpdf = new mPDF();

				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('contratos/contrato-template/template-contrato', $data, TRUE);
				$mpdf->AddPage('','','','','');
				// Define um Cabeçalho para o arquivo PDF
				$mpdf->SetHeader('CIMA SAÚDE');
				// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
				// página através da pseudo-variável PAGENO
				$mpdf->SetFooter('
					<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #000000; font-weight: bold; font-style: italic; border: none; border-collapse:collapse;"> 
					<tr style="border: none;">

						<td width="50%" style="border: none;"><span style="font-weight: bold; font-style: italic;">www.cimasaude.com.br</span></td>

						<td width="50%" style="text-align: right; border: none;">{PAGENO}</td>

						</tr>
					</table>
					');
				// Insere o conteúdo da variável $html no arquivo PDF
				$mpdf->writeHTML($html);
				// Cria uma nova página no arquivo
				//$mpdf->AddPage();
				// Insere o conteúdo na nova página do arquivo PDF
				//$mpdf->WriteHTML('<p><b>Minha nova página no arquivo PDF</b></p>');
				// Gera o arquivo PDF
				//$mpdf->Output();
				$mpdf->Output('Contrato-'. $data['contrato']['numero'] .'.pdf' , 'D');
				return;
			}


		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************

			public function relatorios(){

			$data['form'] = $this->input->post();
			$groupBy = '';
			$orderBy = '';
			$campos = "contratos.*, clientes.nome as cliente_nome, clientes.email as cliente_email, planos.nome as plano_nome";
			$tables = "contratos, clientes, planos";
			$where = "contratos.fk_cliente = clientes.cod_cliente and contratos.fk_plano = planos.cod_plano and";

			if($data['form']['c-inicial'] != ''){
				$where .= ' contratos.dt_contratacao >= "' . formata_data_db($data['form']['c-inicial']). '" AND ';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' contratos.dt_contratacao <= "' . formata_data_db($data['form']['c-final']). '" AND ';
			}

			if($data['form']['v-inicial'] != ''){
				$where .= ' contratos.dt_vencimento <= "' . formata_data_db($data['form']['v-inicial']). '" AND ';
			}

			if($data['form']['v-final'] != ''){
				$where .= 'contratos.dt_vencimento <= "' . formata_data_db($data['form']['v-final']). '" AND ';
			}

			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= ' contratos.dt_contratacao, ';
				
			}

			if($data['form']['v-inicial'] != '' || $data['form']['v-final'] != ''){
				$groupBy .= ' contratos.dt_vencimento, ';
				
			}

			if($data['form']['plano'] != ''){
				$where .= ' fk_plano = "' . $data['form']['plano'] . '" AND';
				$groupBy .= ' contratos.fk_plano,'; 
				
			}

			if($data['form']['status'] != ''){
				$where .= ' status = "' . $data['form']['status'] . '" AND';
				$groupBy .= ' status,';

			}

			//Tirando o último AND e a última vírgula
			//if($where != 'propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano '){
				$where = substr($where, 0 , -4);
			//}
			if($groupBy != ''){
				$groupBy = substr($groupBy, 0 , -1);
			}

			//var_dump($data, $where, $groupBy, $orderBy, "-------------------------************************_______________________");
			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'dt_contratacao');

			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/contratos", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/contratos', $data, TRUE);
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
			$mpdf->Output('Relatorio-Contratos'. date("Ymd").'.pdf' , 'D');
			 redirect('contratos');
		}

	}