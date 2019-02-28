<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Relatorios extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('m-sistema/Relatorio_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
			$this->load->helper('parse');
			$this->load->helper('file');
		}

		public function contratos(){

			$table = "planos";
			$data['dataPlanos'] = $this->Generic_model->readAll($table);

			$this->load->view('commons/sidebar');
			$this->load->view('relatorios/relatorios/contratos', $data);
		}
		
		public function atrasados(){
			echo "atrasados";
		}
		
		public function contas(){
			echo "contas";
		}

		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************

			public function relatorioContratos(){
			
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

			
			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= ' contratos.dt_contratacao, ';
				
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

		public function esteMesContratos() {
			echo "este mes";
		}

		public function estaSemanaContratos() {
			$query = "SELECT * FROM contratos WHERE dt_contratacao BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE()  ORDER BY dt_contratacao";
			$data['dataTable']= $this->Generic_model->justQuery($query);

			

			$this->load->view("relatorios/contratos", $data);
		}		

	}