<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Carteirinhas extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('funcoes');
			$this->load->helper('parse');
			$this->load->helper("file");
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
			$table = 'beneficiarios';
			$data['dataTable'] = $this->Generic_model->readAll($table);

			
			for($i = 0; $i < count($data['dataTable']); $i++) {
				$num = $data['dataTable'][$i]['fk_proposta'];
				$query = "SELECT dt_vencimento, dt_contratacao, fk_plano FROM contratos WHERE cod_proposta = " . $num . ' LIMIT 1';
				$dta = $this->Generic_model->justQuery($query);

				//var_dump($dta[0]); 
			
			 	$data['dataTable'][$i]['dt_contratacao'] = $dta[0]['dt_contratacao'];
			 	$data['dataTable'][$i]['dt_vencimento'] = $dta[0]['dt_vencimento'];
			 	
			 	$data['dataTable'][$i]['plano'] = $dta[0]['fk_plano'];
			}
			//var_dump($data['dataTable']);die;
			$this->load->view('cadastros/carteirinhas/carteirinhas-read', $data);
			
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		
		//Método que renderiza a tela
		public function visualizar($cod, $tab){
			//var_dump($cod, $tab, 'deu certo!');
			if($tab == 1){
				$table = 'clientes';
				$campoId = 'cod_cliente';
				$data['tipo_beneficiario'] = 'Titular';
			} else if ($tab == 2){
				$table = 'propostas_dependentes';
				$campoId = 'cod_dependente';
				$data['tipo_beneficiario'] = 'Dependente';
			}else if ($tab == 3){
				$table = 'propostas_agregados';
				$campoId = 'cod_agregado';
				$data['tipo_beneficiario'] = 'Agregado';
			}else if ($tab == 4){
				$table = 'propostas_colaboradores';
				$campoId = 'cod_colaborador';
				$data['tipo_beneficiario'] = 'Colaborador';
			}
			$data['cod'] = $cod;
			$data['tab'] = $tab;

			$data['beneficiario'] = $this->Generic_model->readById($table, $campoId, $cod);
			//var_dump($data); die;
			$this->load->view('commons/sidebar');
			$this->load->view("cadastros/beneficiarios/beneficiarios-view", $data);
		}

		public function atualizar($cod, $tab){
			var_dump($cod, $tab, 'deu certo!');
		}


		//**********************************************
		//******           RELATÓRIOS          *********
		//**********************************************


		public function relatorios(){
			
			
			$data['form'] = $this->input->post();
			$groupBy = '';
			$orderBy = '';
			$campos = "beneficiarios.*, contratos.*, planos.nome as plano_nome";
			$tables = "beneficiarios, contratos, planos ";
			$where = " beneficiarios.fk_proposta = contratos.cod_proposta AND contratos.fk_plano = planos.cod_plano AND ";

			if($data['form']['c-inicial'] != ''){
				$where .= ' beneficiarios.dt_carteirinha >= "' . formata_data_db($data['form']['c-inicial']). '" AND ';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' beneficiarios.dt_carteirinha <= "' . formata_data_db($data['form']['c-final']). '" AND ';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'beneficiarios.dt_carteirinha, ';
				
			}


			$hoje = date("Y-m-d");
			if($data['form']['date'] != ''){
				if ($data['form']['date'] == 'H') {
					$where .= ' beneficiarios.dt_carteirinha = "' . $hoje . '" AND';
					$groupBy .= 'beneficiarios.dt_carteirinha, '; 
				} else if($data['form']['date'] == 'S'){
					$semana = date("w");
					
					switch ($semana) {
						case '0':
							$dataInicial = date('Y-m-d', strtotime('+0 days', strtotime($hoje)));
							break;

						case '1':
							$dataInicial = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
							break;

						case '2':
							$dataInicial = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
							break;

						case '3':
							$dataInicial = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
							break;

						case '4':
							$dataInicial = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
							break;

						case '5':
							$dataInicial = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
							break;

						case '6':
							$dataInicial = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
							break;
					}
					$where .= ' beneficiarios.dt_carteirinha >= "' . $dataInicial . '" AND beneficiarios.dt_carteirinha <= "' . $hoje. '" AND ';
					//var_dump(date("w"), date('Y-m-d', strtotime('-2 days', strtotime($hoje))), $where); die;
					$groupBy .= 'beneficiarios.dt_carteirinha, ';
				} else if($data['form']['date'] == 'M'){
					$dataInicial = date('Y-m-01');
					$where .= ' beneficiarios.dt_carteirinha >= "' . $dataInicial . '" AND beneficiarios.dt_carteirinha <= "' . $hoje. '" AND ';
					$groupBy .= 'beneficiarios.dt_carteirinha, ';
				} else if($data['form']['date'] == 'M'){
					$dataInicial = date('Y-01-01');
					$where .= ' beneficiarios.dt_carteirinha >= "' . $dataInicial . '" AND beneficiarios.dt_carteirinha <= "' . $hoje. '" AND ';
					$groupBy .= 'beneficiarios.dt_carteirinha, ';
				}
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

			$data['dataTable'] = $this->Generic_model->gerarRelatorio($tables, $campos, $where, $groupBy, 'dt_carteirinha');
			var_dump($data); die;
			if($this->input->post('relatorio') == 'rel'){
				$this->load->view("relatorios/carteirinhas", $data);
			} else {
				$this->pdf_relatorio($data);
			}
		}

		public function pdf_relatorio($data){
			$mpdf = new mPDF();
			$html = $this->load->view('relatorios/templates/carteirinhas', $data, TRUE);
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
			$mpdf->Output('Relatorio-Carteirinhas'. date("Ymd").'.pdf' , 'D');
			 redirect('carteirinhas');
		}

	}	