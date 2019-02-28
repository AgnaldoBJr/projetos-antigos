<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Proposta extends CI_Controller {

		
		function __construct(){
			parent::__construct();

			$this->load->model('m-contratos/Proposta_model');
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

			$campos = "propostas.*, clientes.nome as cliente_nome, clientes.email as cliente_email, planos.nome as plano_nome";
			$tables = "propostas, clientes, planos";
			$where = "propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano";
			$data['dataTable'] = $this->Generic_model->readAndProjectionManyTables($campos, $tables, $where);

			//var_dump($data['dataTable']);die;
			$table = "planos";
			$data['dataPlanos'] = $this->Generic_model->readAll($table);
			//var_dump($data['dataClientes'], $data['dataPlanos']); die;

			$this->load->view('contratos/propostas/propostas-read', $data);
		}


		public function logout(){
			$this->session->sess_destroy();
			redirect('acesso/login');
		}
		

		//Método que renderiza a tela
		public function novo(){
			$dataProposta['propostaNumero'] = $this->gerarNumeroProposta();
			
			$table = "clientes";
			$camposDeProjecao = "cod_cliente, nome";
			$dataProposta['dataClientes'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "planos";
			$dataProposta['dataPlanos'] = $this->Generic_model->readAll($table);
			//var_dump($data['dataClientes'], $data['dataPlanos']); die;

			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-create", $dataProposta);
		}


		//Método que salva os dados a partir de um novo formulário
		public function salvar(){

			$data = $this->input->post(); 
			$data['propostaNumero'] = $data['proposta-numero'];

			$this->form_validation->set_rules('proposta-cliente', 'Cliente', 'required', array('required' => 'Escolha uma opção'));
			$this->form_validation->set_rules('proposta-plano', 'Plano', 'required', array('required' => 'Escolha uma opção'));
 /*
			if(isset($data['proposta-plano'])){
				//$i < 10 (dez é uma constante de quantidade de dependentes) - Mudar a view se necessário
				if(isset($data['dep-nome'])){
					for ($i = 1; $i <= 10; $i++){
						if($data['dep-nome'][$i] != "" || $data['dep-data-nasc'][$i] != "" || $data['dep-parentesco'][$i] != ""){
							$this->form_validation->set_rules('dep-nome['. $i .']', 'Nome', 'required|trim|min_length[5]');
							$this->form_validation->set_rules('dep-data-nasc['. $i .']', 'Dt. Nasc', 'required|trim');
							$this->form_validation->set_rules('dep-parentesco['. $i .']', 'Parentesco', 'required', array('required' => 'Escolha uma opção'));
						}
					}
				}
				//$i < 10 (dez é uma constante de quantidade de agregados) - Mudar a view se necessário
				if(isset($data['agr-nome'])){
					for ($i = 1; $i <= 10; $i++){
						if($data['agr-nome'][$i] != "" || $data['agr-data-nasc'][$i] != "" || $data['agr-parentesco'][$i] != ""){
							$this->form_validation->set_rules('agr-nome['. $i .']', 'Nome', 'required|trim|min_length[5]');
							$this->form_validation->set_rules('dep-data-nasc['. $i .']', 'Dt. Nasc', 'required|trim');
							$this->form_validation->set_rules('dep-parentesco['. $i .']', 'Parentesco', 'required', array('required' => 'Escolha uma opção'));
						}
					}
				}
				//$i < 10 (dez é uma constante de quantidade de colaboradores) - Mudar a view se necessário
				if(isset($data['colab-nome'])){
					for ($i = 1; $i <= 10; $i++){
						if($data['colab-nome'][$i] != "" || $data['colab-data-nasc'][$i] != ""){
							$this->form_validation->set_rules('colab-nome['. $i .']', 'Nome', 'required|trim|min_length[5]');
							$this->form_validation->set_rules('colab-data-nasc['. $i .']', 'Dt. Nasc', 'required|trim');
						}
					}
				}

			}
*/
			//Mensagens de Validação
			$this->form_validation->set_message('required', 'Este campo deve ser preenchido');
			$this->form_validation->set_message('min_length', 'O campo {field} deve ter no mínimo {param} caracteres');
			$this->form_validation->set_message('max_length', 'O campo {field} deve ter no máximo {param} caracteres');
			$this->form_validation->set_message('valid_email', 'Digite um email válido!');
			$this->form_validation->set_message('matches', 'A senhas devem ser iguais!');

			//Se a validação estiver ok...
			if($this->form_validation->run()){
				$dataProposta = $this->parseData($this->input->post());				
				$dataPagamento['dados'] = $dataProposta;
				
				$dataPagamento['dep_nome'] = $data['dep-nome'];
				$dataPagamento['dep_data_nasc'] = $data['dep-data-nasc'];
				$dataPagamento['dep_parentesco'] = $data['dep-parentesco'];

				$dataPagamento['agr_nome'] = $data['agr-nome'];
				$dataPagamento['agr_data_nasc'] = $data['agr-data-nasc'];
				$dataPagamento['agr_parentesco'] = $data['agr-parentesco'];
				

				$dataPagamento['colab_nome'] = $data['colab-nome'];
				$dataPagamento['colab_data_nasc'] = $data['colab-data-nasc'];
				

				$dataPagamento['num_proposta'] = $dataProposta['numero'];
				
				$dataPagamento['contratacao_proposta'] = date("d/m/Y");
				

				$table = "planos";
				$planos = $this->Generic_model->readAll($table);

				foreach ($planos as $dataPlano) {
					if($dataPlano['cod_plano'] == $dataProposta['fk_plano']){
						
						$sub = $dataPlano['valor'];
						$agregados = $this->parseArrayTwo( $data['agr-nome']);
						$colaboradores = $this->parseArrayTwo( $data['colab-nome']);

						//Cálculo de agregados e colaboradores para o subtotal
						if($dataPlano['agregados'] == '1'){
							if($agregados != ""){
								$totalAgregados = $dataPlano['adicional_agregados'] * count($agregados);
								$sub += $totalAgregados;
							}								
						}
						if($dataPlano['colaboradores'] == '1'){
							if($colaboradores != ""){
								$totalColaboradores = $dataPlano['adicional_colaboradores'] * count($colaboradores);
								$sub += $totalColaboradores;
							}	
						}
						//$validade = mktime(0, 0, 0, (date("m") + 1), date("d"), date("Y"));
						$validade = date('d/m/Y', mktime(0, 0, 0, (date("m") + $dataPlano['validade']), date("d"), date("Y")));

					}
				}

				$dataPagamento['subtotal_proposta'] = formata_preco($sub);
				$dataPagamento['vencimento_proposta'] = $validade;
		
				$this->load->view('commons/sidebar');
				$this->load->view("contratos/propostas/propostas-pagamento", $dataPagamento);
				return;
			} 

			$table = "clientes";
			$camposDeProjecao = "cod_cliente, nome";
			$data['dataClientes'] = $this->Generic_model->readAndProjection($table, $camposDeProjecao);
			
			$table = "planos";
			$data['dataPlanos'] = $this->Generic_model->readAll($table);
			
			//Se a validação não estiver correta, enviar dados do plano para mostrar as views corretamente
			//Display: block
			foreach ($data['dataPlanos'] as $dataPlano) {
				if($dataPlano['cod_plano'] == $data['proposta-plano']){
					//var_dump($dataPlano);

					if($dataPlano['dependentes'] == '1'){
						$data['d'] = 1;
					} else {
						$data['d'] = 0;
					}

					if($dataPlano['colaboradores'] == '1'){
						$data['c'] = 1;
					} else {
						$data['c'] = 0;
					}

					if($dataPlano['agregados'] == '1'){
						$data['a'] = 1;
					} else {
						$data['a'] = 0;
					}

				}	
			}
			
			
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-create", $data);		 	
		}


		public function finalizar(){
			//Dados de proposta
			$data['numero_proposta'] = $this->input->post('proposta-numero');
			$data['datas']['contratacao'] = $this->input->post('pag-contratacao');
			$data['datas']['vencimento'] = $this->input->post('pag-vencimento');

			//Dados do Cliente
			$codCliente = $this->input->post('proposta-cliente');
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $codCliente);

			//Dados do Plano
			$codPlano = $this->input->post('proposta-plano');
			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $codPlano);

			//Dados de Pagamento
			$data['pagamento']['subtotal'] = 'R$ ' . $this->input->post('subtotal_proposta');
			$data['pagamento']['desconto'] = ($this->input->post('pag-desconto') != "") ? $this->input->post('pag-desconto') . "%" : "Não aplicado";
			
			$sub = (int)  formata_preco_db($this->input->post('subtotal_proposta'));
			$desc = ($this->input->post('pag-desconto') != "") ? (float) $this->input->post('pag-desconto') * 0.01 : "";
			$total = ($desc != "") ? ($sub - ($sub * $desc)) : $sub;
			
			//var_dump($this->input->post()); die;
			
			if($this->input->post('pag-num') != ""){	
				$num = ($this->input->post('pag-num'));
			}	else{
				$num = 0;
			}
			
			$parcela = ($num != 0) ? ($total/$num) : 0;

			$data['pagamento']['total'] = 'R$ ' . formata_preco($total);
			$data['pagamento']['modo'] = $this->forma($this->input->post('pag-modo'));
			$data['pagamento']['modo_cod'] = $this->input->post('pag-modo');
			$data['pagamento']['qtd_parcelas'] = $num;
			$data['pagamento']['valor_parcelas'] = 'R$ ' . formata_preco($parcela);
			//-------------------------------------
			$texto = "";
			if($num != 0)
				$texto .= $num . " parcelas de " . $data['pagamento']['valor_parcelas'];

			$data['pagamento']['texto'] = $texto;
			$data['pagamento']['melhor_dia'] = $this->input->post('melhor-dia');

			//var_dump($texto); die;
			//-------------------------------------

			//Observações
			$data['observacoes'] = $this->input->post('plano-observacoes');

			//Dependentes
			$data['dependentes']['dep_nome'] = $this->parseArray($this->input->post('dep-nome'));
			$data['dependentes']['dep_data'] = $this->parseArray($this->input->post('dep-data-nasc'));
			$data['dependentes']['dep_parentesco'] = $this->parseArray($this->input->post('dep-parentesco'));
			
			//Agregados
			$data['agregados']['agr_nome'] = $this->parseArray($this->input->post('agr-nome'));
			$data['agregados']['agr_data'] = $this->parseArray($this->input->post('agr-data-nasc'));
			$data['agregados']['agr_parentesco'] = $this->parseArray($this->input->post('agr-parentesco'));
			
			//Colaboradores
			$data['colaboradores']['colab_nome'] = $this->parseArray($this->input->post('colab-nome'));
			$data['colaboradores']['colab_data'] = $this->parseArray($this->input->post('colab-data-nasc'));
			//var_dump($data, "------------------------"); die;
			//var_dump($this->input->post()); die;
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-finalizar" , $data);
		}



		public function contratar(){
			//var_dump($this->input->post()); die;
			if($this->input->post('proposta-status') == "Cancelar"){
				$this->session->set_flashdata('cancel', 'Proposta Cancelada!');
		      			redirect('propostas');	
			} else if($this->input->post('proposta-status') == "Concluir"){
				
				//Preparação dos dados para salvar uma proposta ou gerar um contrato
				//1. Preparação dos dados para a tabela proposta
				$data['proposta'] = parseProposta($this->input->post(), $this->session->userdata('id'));

				//------------------------------------------------------------------
				//2. Preparação dos dados para as tabelas proposta_dependentes, proposta_agregados, proposta_colaboradores
				//Tratar os dados que serão inseridos como 
				//var_dump(count($this->input->post('dep_nome')), count($this->input->post('agr_nome')), count($this->input->post('colab_nome')));			

				$dependentes = ""; $agregados = ""; $colaboradores = "";
				if($this->input->post('dep_nome') != null)
					$dependentes = tratarDadosPessoas($this->input->post('dep_nome'), $this->input->post('dep_data'), $this->input->post('dep_parentesco'), count($this->input->post('dep_nome')));
				if($this->input->post('agr_nome') != null)
					$agregados = tratarDadosPessoas($this->input->post('agr_nome'), $this->input->post('dep_data'), $this->input->post('agr_parentesco'), count($this->input->post('agr_nome')));
				if($this->input->post('colab_nome') != null)
					$colaboradores = tratarDadosColaboradores($this->input->post('colab_nome'), $this->input->post('colab_data'), count($this->input->post('colab_nome')));
				//var_dump($data['proposta'], $dependentes, $agregados, $colaboradores); die;

				//SALVANDO DADOS DA PROPOSTA, DEPENDENTES, AGREGADOS, COLABORADORES
				$resultado = $this->Proposta_model->insert($data['proposta'], $dependentes, $agregados, $colaboradores);
				
			
				$array_msg = array();
				if($this->input->post('imprimir') == 1){
					//var_dump($resultado, $resultado['cod_proposta'], $data['proposta']['numero']); die;	
					$this->session->set_flashdata('imprimir', $resultado);
					//echo "vai imprimir";
				}

				if($this->input->post('email') == 1){
					//$this->session->set_flashdata('enviar', 'enviar');
					$this->enviarEmailProposta($resultado, $this->input->post('destino'), $this->input->post('msg'));
				}



				if($resultado == true){
					$array_msg['success'] = 'Proposta salva com sucesso!';
					
					$this->session->set_flashdata('msg', 'Proposta salva com sucesso!');	
					redirect('propostas');
		      		
		      	}
		      	else{
					$this->session->set_flashdata('err', 'Não cadastrado! Tente novamente!');
					redirect('propostas');
				}
			}
		}


		//Método que carrega uma view de formulário para ser vizualizado
		public function visualizar($cod){
		
			$data['proposta'] = $this->Generic_model->readById('propostas', 'cod_proposta', $cod);
			$data['proposta']['dt_contratacao'] = formata_data_br($data['proposta']['dt_contratacao']);

			$data['proposta']['modo']= $this->forma($data['proposta']['pag_modo_pagamento']);
			$data['proposta']['pag_subtotal']= 'R$ ' . formata_preco($data['proposta']['pag_subtotal']);
			$data['proposta']['pag_total']= 'R$ ' . formata_preco($data['proposta']['pag_total']);
			$data['proposta']['pag_desconto']= ($data['proposta']['pag_desconto'] != "Não aplicado") ? $data['proposta']['pag_desconto'] . '%' : $data['proposta']['pag_desconto'];
			$data['proposta']['pag_valor_parcelas']= 'R$ ' . formata_preco($data['proposta']['pag_valor_parcelas']);


			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['proposta']['fk_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['proposta']['fk_plano']);

			if($data['plano']['dependentes'] == "1")
				$data['dependentes'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_dependentes', 'fk_proposta = ' . $cod);

			if($data['plano']['agregados'] == "1")
				$data['agregados'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_agregados', 'fk_proposta = ' . $cod);

			if($data['plano']['colaboradores'] == "1")
				$data['colaboradores'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_colaboradores', 'fk_proposta = ' . $cod);

			//var_dump($data); die;
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-view", $data);

		}

		//Método que carrega uma view de formulário para ser vizualizado
		public function novoPDF($cod){
			$data['proposta'] = $this->Generic_model->readById('propostas', 'cod_proposta', $cod);

			$data['proposta']['modo']= $this->forma($data['proposta']['pag_modo_pagamento']);

			$data['texto'] = "";
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['proposta']['fk_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['proposta']['fk_plano']);

			if($data['plano']['dependentes'] == "1")
				$data['dependentes'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_dependentes', 'fk_proposta = ' . $cod);

			if($data['plano']['agregados'] == "1")
				$data['agregados'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_agregados', 'fk_proposta = ' . $cod);

			if($data['plano']['colaboradores'] == "1")
				$data['colaboradores'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_colaboradores', 'fk_proposta = ' . $cod);

			//echo "novoPDF";
			//var_dump($cod); die;

			//var_dump($data['dependentes']); die;
				//var_dump($data); die;
				// Instancia a classe mPDF
				$mpdf = new mPDF();

				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('contratos/contrato-template/template2', $data, TRUE);
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
				$mpdf->Output('Proposta-'. $data['proposta']['numero'] .'.pdf' , 'D');
				return;
		}


		//Método que carrega uma view de formulário para ser vizualizado
		public function novoContratoPDF($cod){
			$data['contrato'] = $this->Generic_model->readById('contratos', 'cod_contrato', $cod);

			$data['contrato']['modo']= $this->forma($data['contrato']['pag_modo_pagamento']);

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


		public function relatorios(){
			
			
			$data['form'] = $this->input->post();
			$groupBy = '';
			$orderBy = '';
			$campos = "propostas.*, clientes.nome as cliente_nome, clientes.email as cliente_email, planos.nome as plano_nome";
			$tables = "propostas, clientes, planos";
			$where = "propostas.fk_cliente = clientes.cod_cliente and propostas.fk_plano = planos.cod_plano and";

			if($data['form']['c-inicial'] != ''){
				$where .= ' propostas.dt_contratacao >= "' . formata_data_db($data['form']['c-inicial']). '" AND';
			}
			if($data['form']['c-final'] != ''){
				$where .= ' propostas.dt_contratacao <= "' . formata_data_db($data['form']['c-final']). '" AND';
			}


			if($data['form']['c-inicial'] != '' || $data['form']['c-final'] != ''){
				$groupBy .= 'propostas.dt_contratacao, ';
				
			}


			if($data['form']['plano'] != ''){
				$where .= ' fk_plano = "' . $data['form']['plano'] . '" AND';
				$groupBy .= 'propostas.fk_plano,'; 
				
			}

			if($data['form']['status'] != ''){
				$where .= ' status = "' . $data['form']['status'] . '" AND';
				$groupBy .= 'status,';

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

			
			$this->load->view("relatorios/propostas", $data);
		}

		//Método que carrega uma view de formulário para ser alterado
		public function atualizar($cod){
			

			$table = 'propostas';
			$campoId = 'cod_proposta';
			$id = $cod;
			$data['proposta'] = $this->Generic_model->readById($table, $campoId, $id);
			
			$table = 'clientes';
			$campoId = 'cod_cliente';
			$id = $data['proposta']['fk_cliente'];
			$data['cliente'] = $this->Generic_model->readById($table, $campoId, $id);
			
			$table = 'planos';
			$campoId = 'cod_plano';
			$id = $data['proposta']['fk_plano'];
			$data['plano'] = $this->Generic_model->readById($table, $campoId, $id);

			$table = 'propostas_dependentes';
			$campoId = 'fk_proposta';
			$id = $cod;
			$data['dependentes'] = $this->Generic_model->readAllWhere($table, $campoId, $id);

			$table = 'propostas_agregados';
			$campoId = 'fk_proposta';
			$id = $cod;
			$data['agregados'] = $this->Generic_model->readAllWhere($table, $campoId, $id);

			$table = 'propostas_colaboradores';
			$campoId = 'fk_proposta';
			$id = $cod;
			$data['colaboradores'] = $this->Generic_model->readAllWhere($table, $campoId, $id);

			//var_dump($data['dependentes']); die;
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-update", $data);
			
		}

		//Método que altera os dados no banco a partir de um formulário carregado
		public function alterar(){
			$post = $this->input->post();

			$data['codigo'] = $this->input->post('cod_proposta');
			$data['numero_proposta'] = $this->input->post('proposta-numero');
			$data['datas']['contratacao'] = $this->input->post('pag-contratacao');
			$data['datas']['vencimento'] = $this->input->post('pag-vencimento');


	//Buscar dados do cliente e do plano
			//Dados do Cliente
			$codCliente = $this->input->post('cod_cliente');
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $codCliente);

			//Dados do Plano
			$codPlano = $this->input->post('cod_plano');
			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $codPlano);

	//Atualizar os campos de pagamento
			//Calcular novo subtotal
			$sub = $data['plano']['valor'];
			//var_dump($data['plano']);
			$agregados = $this->parseArray( $post['agr-nome']);
			$colaboradores = $this->parseArray( $post['colab-nome']);

			//Cálculo de agregados e colaboradores para o subtotal
			if($data['plano']['agregados'] == '1'){
				if($agregados != ""){
					$totalAgregados = $data['plano']['adicional_agregados'] * count($agregados);
					$sub += $totalAgregados;
				}								
			}
			if($data['plano']['colaboradores'] == '1'){
				if($colaboradores != ""){
					$totalColaboradores = $data['plano']['adicional_colaboradores'] * count($colaboradores);
					$sub += $totalColaboradores;
				}	
			}

			//Dados de Pagamento
			$data['pagamento']['subtotal'] = 'R$ ' . formata_preco($sub);
			$data['pagamento']['desconto'] = ($this->input->post('pag-desconto') != "") ? $this->input->post('pag-desconto') . "%" : "Não aplicado";
			
			$desc = ($this->input->post('pag-desconto') != "") ? (float) $this->input->post('pag-desconto') * 0.01 : "";
			$total = ($desc != "") ? ($sub - ($sub * $desc)) : $sub;
			
			//var_dump($this->input->post()); die;
			
			if($this->input->post('pag-num') != ""){	
				$num = ($this->input->post('pag-num'));
			}	else{
				$num = 0;
			}
			
			$parcela = ($num != 0) ? ($total/$num) : 0;

			$data['pagamento']['total'] = 'R$ ' . formata_preco($total);
			$data['pagamento']['modo'] = $this->forma($this->input->post('pag-modo'));
			$data['pagamento']['modo_cod'] = $this->input->post('pag-modo');
			$data['pagamento']['qtd_parcelas'] = $num;
			$data['pagamento']['valor_parcelas'] = 'R$ ' . formata_preco($parcela);
			//-------------------------------------
			$texto = "";
			if($num != 0)
				$texto .= $num . " parcelas de " . $data['pagamento']['valor_parcelas'];

			$data['pagamento']['texto'] = $texto;
			$data['pagamento']['melhor_dia'] = $this->input->post('melhor-dia');

			//var_dump($texto); die;
			//-------------------------------------

			//Observações
			$data['observacoes'] = $this->input->post('plano-observacoes');
	//Arrays de Pessoas
			//Dependentes
			$data['dependentes']['dep_nome'] = $this->parseArray($this->input->post('dep-nome'));
			$data['dependentes']['dep_data'] = $this->parseArray($this->input->post('dep-data-nasc'));
			$data['dependentes']['dep_parentesco'] = $this->parseArray($this->input->post('dep-parentesco'));
			
			//Agregados
			$data['agregados']['agr_nome'] = $this->parseArray($this->input->post('agr-nome'));
			$data['agregados']['agr_data'] = $this->parseArray($this->input->post('agr-data-nasc'));
			$data['agregados']['agr_parentesco'] = $this->parseArray($this->input->post('agr-parentesco'));
			
			//Colaboradores
			$data['colaboradores']['colab_nome'] = $this->parseArray($this->input->post('colab-nome'));
			$data['colaboradores']['colab_data'] = $this->parseArray($this->input->post('colab-data-nasc'));
			
			//var_dump($data, "------------------------"); die;
			//var_dump($this->input->post()); die;
			$this->load->view('commons/sidebar');
			$this->load->view("contratos/propostas/propostas-finalizar-update" , $data);
	      	
		}

		public function update() {
			//var_dump($this->input->post()); die;
			if($this->input->post('proposta-status') == "Cancelar"){
				$this->session->set_flashdata('cancel', 'Alteração Cancelada!');
		      			redirect('propostas');	
			} else if($this->input->post('proposta-status') == "Concluir"){
				
				//Preparação dos dados para salvar uma proposta ou gerar um contrato
				//1. Preparação dos dados para a alteração na tabela proposta
				$data['proposta'] = parseProposta($this->input->post(), $this->session->userdata('id'));
				//------------------------------------------------------------------
				//2. Preparação dos dados para as tabelas proposta_dependentes, proposta_agregados, proposta_colaboradores
				//Tratar os dados que serão inseridos como 
				//var_dump(count($this->input->post('dep_nome')), count($this->input->post('agr_nome')), count($this->input->post('colab_nome')));			

				$dependentes = ""; $agregados = ""; $colaboradores = "";
				if($this->input->post('dep_nome') != null)
					$dependentes = tratarDadosPessoas($this->input->post('dep_nome'), $this->input->post('dep_data'), $this->input->post('dep_parentesco'), count($this->input->post('dep_nome')));
				if($this->input->post('agr_nome') != null)
					$agregados = tratarDadosPessoas($this->input->post('agr_nome'), $this->input->post('dep_data'), $this->input->post('agr_parentesco'), count($this->input->post('agr_nome')));
				if($this->input->post('colab_nome') != null)
					$colaboradores = tratarDadosColaboradores($this->input->post('colab_nome'), $this->input->post('colab_data'), count($this->input->post('colab_nome')));
				//var_dump($data['proposta'], $dependentes, $agregados, $colaboradores); die;

				//EXCLUINDO DADOS DA PROPOSTA, DEPENDENTES, AGREGADOS, COLABORADORES
				$this->Generic_model->delete("propostas_dependentes", 'fk_proposta', $this->input->post("cod_proposta"));
				$this->Generic_model->delete("propostas_agregados", 'fk_proposta', $this->input->post("cod_proposta"));
				$this->Generic_model->delete("propostas_colaboradores", 'fk_proposta', $this->input->post("cod_proposta"));

				//SALVANDO DADOS DA PROPOSTA, DEPENDENTES, AGREGADOS, COLABORADORES
				$resultado = $this->Proposta_model->updateProposta($this->input->post("cod_proposta"), $data['proposta'], $dependentes, $agregados, $colaboradores);
								
			
				$array_msg = array();
				if($this->input->post('imprimir') == 1){
					//var_dump($resultado, $resultado['cod_proposta'], $data['proposta']['numero']); die;	
					$this->session->set_flashdata('imprimir', $resultado);
					//echo "vai imprimir";
				}

				if($this->input->post('email') == 1){
					$this->session->set_flashdata('enviar', 'enviar');
					//echo "vai enviar";
				}



				if($resultado == true){
					$array_msg['success'] = 'Proposta alterada com sucesso!';
					
					$this->session->set_flashdata('msg', 'Proposta alterada com sucesso!');	
					redirect('propostas');
		      		
		      	}
		      	else{
					$this->session->set_flashdata('err', 'Não alterada! Tente novamente!');
					redirect('propostas');
				}
			}
		}

		//Método para deletar um registro
		public function delete(){
			$data = $this->input->post('cod_proposta');
			$table = 'propostas';
			$campoId = 'cod_proposta';

			$resultado = $this->Generic_model->delete($table, $campoId, $data);

			if($resultado){
      			redirect('propostas');
      		}
		}


		public function ganhar(){
				//var_dump($this->input->post());die;
			$data = $this->Generic_model->readById('propostas', 'cod_proposta', $this->input->post('cod_proposta'));
			
			//Mudando o status da proposta
			$status = array('status' => 'C' ); 
			$table = 'propostas';
			$campoId = 'cod_proposta';
			$id = $data['cod_proposta'];


			$r = $this->Generic_model->update($table, $campoId, $id, $status);

			//Gerando a data de vencimento do contrato
			$resultado =$this->Generic_model->readAndProjectionById('validade', 'planos', 'planos.cod_plano='. $data['fk_plano']);
			$meses  = convertCodigoValidadePlanos($resultado[0]['validade']);


			$data['dt_contratacao'] = date('Y-m-d');
			$data['dt_vencimento'] = date('Y-m-d', mktime(0, 0, 0, (date("m") + $meses), date("d"), date("Y")));

			//Gerando número do contrato
			$data['numero'] = $this->gerarNumeroContrato();

			//Gerando número do contrato
			$data['status'] = 'C';

			//Salvando Contrato
			$resultado = $this->Generic_model->insert('contratos', 'cod_contrato', $data);
			$data['fk_contrato'] = $resultado['cod_contrato'];


			//Gerando  e salvando as contas a receber
			if($data['pag_qtd_parcelas'] == null || $data['pag_qtd_parcelas'] == 0 || $data['pag_qtd_parcelas'] == ""){
				var_dump("ok");
				$conta = parseConta($data, 1, 0, $this->session->userdata('id'), 0);
				$res = $this->Generic_model->insert('contas_a_receber', 'cod_conta_a_receber', $conta);
			} else {
				for($i = 1; $i <= $data['pag_qtd_parcelas']; $i++){
					//Gerando a data de venvimento da parcela
					
					$vencimento_parcela = 0;
					if($data['pag_melhor_dia'] != ''){
						if(date('d') < $data['pag_melhor_dia']){
							$vencimento_parcela = date('Y-m-d', mktime(0, 0, 0, (date("m") + ($i-1)), $data['pag_melhor_dia'], date("Y")));
						} else {
							$vencimento_parcela = date('Y-m-d', mktime(0, 0, 0, (date("m") + $i), $data['pag_melhor_dia'], date("Y")));
						}
					}					
	
					$conta['parcelas'][$i] = parseConta($data, 2, $i, $this->session->userdata('id'), $vencimento_parcela);
					$res = $this->Generic_model->insert('contas_a_receber', 'cod_conta_a_receber', $conta['parcelas'][$i]);
				}
			}

			

			$array_msg = array();
			if($this->input->post('imprimir') == 1){
				//var_dump($resultado, $resultado['cod_proposta'], $data['proposta']['numero']); die;	
				$this->session->set_flashdata('imprimirContrato',  $resultado['cod_contrato']);
				//echo "vai imprimir";
			}

			if($this->input->post('email') == 1){
				//$this->session->set_flashdata('enviar', 'enviar');
				//echo "vai enviar";
				$this->enviarEmailContrato($resultado['cod_contrato'], $this->input->post('destino'), $this->input->post('msg'));
			}



			if($resultado == true){
				$array_msg['success'] = 'Proposta alterada com sucesso!';
				
				$this->session->set_flashdata('msg', 'Proposta alterada com sucesso!');	
				redirect('propostas');
	      		
	      	}
	      	else{
				$this->session->set_flashdata('err', 'Não alterada! Tente novamente!');
				redirect('propostas');
			}
		


		}
				
				




//-------------------------------------------------------------------------------------------------------------------
		public function parseArray($data){
			//var_dump($data);
			$dataParse = "";
			$k = 0;
			for($i= 0; $i < count($data); $i++) {
				if($data[$i] != ""){
					$dataParse[$k] = $data[$i];
					$k++;
				}
			}
			//var_dump($dataParse); die;

			return $dataParse;
		}

		public function parseArrayTwo($data){
			//var_dump($data);
			$dataParse = "";
			$k = 0;
			for($i= 0; $i < count($data); $i++) {
				if($data[$i+1] != ""){
					$dataParse[$k] = $data[$i+1];
					$k++;
				}
			}
			//var_dump($dataParse); die;

			return $dataParse;
		}


		//Método para tratar os dados em um array para o banco de dados
		public function parseData($data){

			if($data['proposta-status'] == "Salvar proposta"){
				$data['proposta-status'] = '1';
			}
			if($data['proposta-status'] == "Próximo"){
				$data['proposta-status'] = '2';
			}
			if($data['proposta-status'] == "Avaliar"){
				$data['proposta-status'] = '3';
			}

			$parseData = array(
					'numero' => $data['proposta-numero'],
					'fk_plano' => $data['proposta-plano'],
					'fk_cliente' => $data['proposta-cliente'],
					'status' => $data['proposta-status'],
					'fk_acesso' => $this->session->userdata('id'),
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;
		}


		public function parseDataCliente($data){
			$parseData = array(
				'tipo' => $data['cliente-tipo'],
				'nome' => $data['cliente-nome'],
				'data_nasc' => $data['cliente-data-nasc'],
				'cpf' => $data['cliente-cpf'],
				'rg' => $data['cliente-rg'],
				//'sexo' => $data['cliente-sexo'],
				'estado_civil' => $data['cliente-estado-civil'],
				//'razao_social' => $data['cliente-razao-social'],
				//'nome_fantasia' => $data['cliente-nome-fantasia'],
				//'cnpj' => $data['cliente-cnpj'],
				'telefone' => $data['cliente-telefone'],
				'celular' => $data['cliente-celular'],
				//'celular_sec' => $data['cliente-celular-sec'],
				'email' => $data['cliente-email'],
				//'site' => $data['cliente-site'],
				'fk_endereco' => '1',
				'fk_acesso' => $this->session->userdata('id'),
				'dt_cadastro' => date("Y-m-d H:i:s"));

			return $parseData;
		}

		

		public function gerarNumeroProposta(){
			$table = 'propostas';
			$campoId = 'cod_proposta';
			$numeroProposta = 'P-' . date("Y"). date("m") . date("d");
			$cod = (int) $this->Generic_model->lastInsert($table, $campoId) + 1;
			$numeroProposta .= (string) $cod;
			return $numeroProposta;
		}

		public function gerarNumeroContrato(){
			$table = 'contratos';
			$campoId = 'cod_contrato';
			$numeroContrato = 'C-' . date("Y"). date("m") . date("d");
			$cod = (int) $this->Generic_model->lastInsert($table, $campoId) + 1;
			$numeroContrato .= (string) $cod;
			return $numeroContrato;
		}

		public function gerarPDF($data){
			{
				
			
			//var_dump($resultado['dataPlanos']); die;
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['cod_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['cod_plano']);

			//Dependentes
			$data['dependentes']['dep_nome'] = $this->input->post('dep_nome');
			$data['dependentes']['dep_cpf'] = $this->input->post('dep_cpf');
			$data['dependentes']['dep_data'] = $this->input->post('dep_data');
			
			//Agregados
			$data['agregados']['agr_nome'] = $this->input->post('agr_nome');
			$data['agregados']['agr_cpf'] = $this->input->post('agr_cpf');
			$data['agregados']['agr_data'] = $this->input->post('agr_data');
			
			//Colaboradores
			$data['colaboradores']['colab_nome'] = $this->input->post('colab_nome');
			$data['colaboradores']['colab_cpf'] = $this->input->post('colab_cpf');
			$data['colaboradores']['colab_data'] = $this->input->post('colab_data');

			//var_dump($data['dependentes']); die;
				//var_dump($data); die;
				// Instancia a classe mPDF
				$mpdf = new mPDF();
				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('contratos/contrato-template/template1', $data, TRUE);
				
				// Define um Cabeçalho para o arquivo PDF
				$mpdf->SetHeader('Contrato Cima Saúde (Exemplo)');
				// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
				// página através da pseudo-variável PAGENO
				//$mpdf->SetFooter('{PAGENO}');
				// Insere o conteúdo da variável $html no arquivo PDF
				$mpdf->writeHTML($html);
				// Cria uma nova página no arquivo
				//$mpdf->AddPage();
				// Insere o conteúdo na nova página do arquivo PDF
				//$mpdf->WriteHTML('<p><b>Minha nova página no arquivo PDF</b></p>');
				// Gera o arquivo PDF
				//$mpdf->Output();
				$mpdf->Output('Proposta-'. $data['numero_proposta'] .'.pdf' , 'D');
				return;
			}
		}


		//Função modificada de: http://www.geradorcpf.com/script-validar-cpf-php.htm
		//Data: 13/03/2017
		public function validate_cpf($cpf){
		    // Elimina possivel mascara
		    $cpf = preg_replace('/[^0-9]/', '', $cpf);
		    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		    
		    // Verifica se o numero de digitos informados é igual a 11 
		    if (strlen($cpf) != 11) {
		        $this->form_validation->set_message('validate_cpf', 'CPF inválido');
		        return false;
		    }
		    // Verifica se nenhuma das sequências invalidas abaixo 
		    // foi digitada. Caso afirmativo, retorna falso
		    else if ($cpf == '00000000000' || 
		        $cpf == '11111111111' || 
		        $cpf == '22222222222' || 
		        $cpf == '33333333333' || 
		        $cpf == '44444444444' || 
		        $cpf == '55555555555' || 
		        $cpf == '66666666666' || 
		        $cpf == '77777777777' || 
		        $cpf == '88888888888' || 
		        $cpf == '99999999999') {
		    	$this->form_validation->set_message('validate_cpf', 'CPF inválido');
		        return false;
		     // Calcula os digitos verificadores para verificar se o
		     // CPF é válido
		     } else {   
		         
		        for ($t = 9; $t < 11; $t++) {
		             
		            for ($d = 0, $c = 0; $c < $t; $c++) {
		                $d += $cpf{$c} * (($t + 1) - $c);
		            }
		            $d = ((10 * $d) % 11) % 10;
		            if ($cpf{$c} != $d) {
		                $this->form_validation->set_message('validate_cpf', 'CPF inválido');
		                return false;
		            }
		        }
		 
		        return true;
		    }
		}

		public function parseFloat($s){
			//var_dump($s);
			$s = substr($s, 3);
			$s = str_replace(",", ".", $s);
			//$s = (number_format($s, 2));
			

			return $s;
		}



		public function parseMoney($s){
			$s = str_replace(".", ",", $s);
			
			//var_dump($s);

			return $s;
		}

		public function validate_desconto($desconto){
			if($desconto < 1 && $desconto > 100){
				$this->form_validation->set_message('validate_desconto', 'O valor deve estar entre 1 e 100');
		        return false;	
			}
			else
				return true;

		}

		public function forma($modo){
			switch ($modo) {
				case '1':
					return "Dinheiro";
				
				case '2':
					return "Cartão - Débito";
				
				case '3':
					return "Cheque";
				
				case '4':
					return "Boleto";
				
				case '5':
					return "Cartão - Crédito";
				
				case '6':
					return "";
			}
		}

		public function enviarEmail(){
			$mpdf = new mPDF();
				// Ao invés de imprimir a view 'welcome_message' na tela, passa o código
				// HTML dela para a variável $html
				$html = $this->load->view('contratos/contrato-template/template1', $data, TRUE);
				
				// Define um Cabeçalho para o arquivo PDF
				$mpdf->SetHeader('Contrato Cima Saúde (Exemplo)');
				// Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
				// página através da pseudo-variável PAGENO
				//$mpdf->SetFooter('{PAGENO}');
				// Insere o conteúdo da variável $html no arquivo PDF
				$mpdf->writeHTML("Exemplo");
				// Cria uma nova página no arquivo
				//$mpdf->AddPage();
				// Insere o conteúdo na nova página do arquivo PDF
				//$mpdf->WriteHTML('<p><b>Minha nova página no arquivo PDF</b></p>');
				// Gera o arquivo PDF
				//$mpdf->Output();
				$mpdf->Output('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\proposta.pdf' , 'F');
				

	        // Carrega a library email
	        $this->load->library('email');
	        //Recupera os dados do formulário
	        $dados = $this->input->post();
	         
	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
	         
	        /*
	         * Se o usuário escolheu o envio com template, define o 'mailtype' para html, 
	         * caso contrário usa text
	         */
	        //if(isset($dados['template']))
	            $config['mailtype'] = 'html';
	        //else
	        //    $config['mailtype'] = 'text';
	 
	        // Inicializa a library Email, passando os parâmetros de configuração
	        $this->email->initialize($config);
	        
	        // Define remetente e destinatário
	        $this->email->from('noreply@email.com', 'Remetente'); // Remetente
	        $this->email->to('agnaldoburgojr@gmail.com',$dados['nome']); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Enviando emails com a library nativa do CodeIgniter');
			$logo = $this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg', 'inline');	 

			
	        /*
	         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
	         * caso contrário passa somente o conteúdo do campo 'mensagem'
	         */
	        //if(isset($dados['template']))
	        //    $this->email->message($this->load->view('contratos/propostas/email-templates',$dados, TRUE));
	        //else
	            $this->email->message($dados['mensagem']);

	        
	        $filename = 'C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg';
			$this->email->attach($filename, 'inline');
        	$cid = $this->email->attachment_cid($filename);
        	$this->email->message('<img src="cid:'. $cid .'" alt="photo1" />');

        	


	        /*
	         * Se foi selecionado o envio de um anexo, insere o arquivo no email 
	         * através do método 'attach' da library 'Email'
	         */
	        //if(isset($dados['anexo']))
	//          $this->email->attach(base_url().'pdf/proposta.pdf');
	 			$this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\proposta.pdf');
	 
unlink('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\proposta.pdf');
//			

	        /*
	         * Se o envio foi feito com sucesso, define a mensagem de sucesso
	         * caso contrário define a mensagem de erro, e carrega a view home
	         */
	        if($this->email->send())
	        {
	            $this->session->set_flashdata('msg','Email enviado com sucesso!');
	            redirect('propostas');
	        }
	        else
	        {
	            $this->session->set_flashdata('msg',$this->email->print_debugger());
	            redirect('propostas');
	        }
		}

		public function enviarEmailProposta($cod, $destino, $msg){
			//Criando o PDF da proposta

			$data['proposta'] = $this->Generic_model->readById('propostas', 'cod_proposta', $cod);

			$data['proposta']['modo']= $this->forma($data['proposta']['pag_modo_pagamento']);

			$data['texto'] = "";
			$data['cliente'] = $this->Generic_model->readById('clientes', 'cod_cliente', $data['proposta']['fk_cliente']);

			$data['plano'] = $this->Generic_model->readById('planos', 'cod_plano', $data['proposta']['fk_plano']);

			if($data['plano']['dependentes'] == "1")
				$data['dependentes'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_dependentes', 'fk_proposta = ' . $cod);

			if($data['plano']['agregados'] == "1")
				$data['agregados'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_agregados', 'fk_proposta = ' . $cod);

			if($data['plano']['colaboradores'] == "1")
				$data['colaboradores'] = $this->Generic_model->readAndProjectionManyTables('*', 'propostas_colaboradores', 'fk_proposta = ' . $cod);

			
				$mpdf = new mPDF();
				$html = $this->load->view('contratos/contrato-template/template2', $data, TRUE);
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
				
				$mpdf->Output('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Proposta-'. $data['proposta']['numero'] .'.pdf' , 'F');
				


			//Enviando o PDF da proposta por email

	        $this->load->library('email');
	         
	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
	        $config['mailtype'] = 'html';
	        
	        $this->email->initialize($config);
	        
	        // Define remetente e destinatário
	        $this->email->from('noreply@cimasaude.com', 'Remetente'); // Remetente
	        $this->email->to($destino); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Proposta CIMA SAÚDE');
			//$logo = $this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg', 'inline');	 

			
	        /*
	         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
	         * caso contrário passa somente o conteúdo do campo 'mensagem'
	         */
	        //if(isset($dados['template']))
	        //    $this->email->message($this->load->view('contratos/propostas/email-templates',$dados, TRUE));
	        //else

	        $message = $msg . '<br><br>';
	        $message .='Atenciosamente, <br>Depto. Comercial CIMA SAÚDE<br><br>';
	        
	        
	        $logo = 'C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg';
			$this->email->attach($logo, 'inline');
        	$cid = $this->email->attachment_cid($logo);
        	$message .= '<img src="cid:'. $cid .'" alt="photo1" />';


        	$this->email->message($message);
	 		$this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Proposta-'. $data['proposta']['numero'] .'.pdf');
	 
			

        	//Exclui o arquivo PDF da página
			unlink('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Proposta-'. $data['proposta']['numero'] .'.pdf');
			

	        //Envia o email e redireciona para a página
	        if($this->email->send())
	        {
	            $this->session->set_flashdata('msg','Proposta salva e e-mail enviado com sucesso!');
	            redirect('propostas');
	        }
	        else
	        {
	            $this->session->set_flashdata('msg', 'Proposta salva e e-mail não enviado! ERROR: '.$this->email->print_debugger());
	            redirect('propostas');
	        }

				

		}

		public function enviarEmailContrato($cod, $destino, $msg){
			//Criando o PDF da proposta
			$data['contrato'] = $this->Generic_model->readById('contratos', 'cod_contrato', $cod);

			$data['contrato']['modo']= $this->forma($data['contrato']['pag_modo_pagamento']);

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

			
				$mpdf = new mPDF();

				
				$html = $this->load->view('contratos/contrato-template/template-contrato', $data, TRUE);
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
				$mpdf->Output('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-'. $data['contrato']['numero'] .'.pdf' , 'F');
				


			//Enviando o PDF da proposta por email

	        $this->load->library('email');
	         
	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
	        $config['mailtype'] = 'html';
	        
	        $this->email->initialize($config);
	        
	        // Define remetente e destinatário
	        $this->email->from('noreply@cimasaude.com', 'Remetente'); // Remetente
	        $this->email->to($destino); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Contrato CIMA SAÚDE');
			//$logo = $this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg', 'inline');	 

			
	        /*
	         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
	         * caso contrário passa somente o conteúdo do campo 'mensagem'
	         */
	        //if(isset($dados['template']))
	        //    $this->email->message($this->load->view('contratos/propostas/email-templates',$dados, TRUE));
	        //else

	        $message = $msg . '<br><br>';
	        $message .='Atenciosamente, <br>Depto. Comercial CIMA SAÚDE<br><br>';
	        
	        
	        $logo = 'C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg';
			$this->email->attach($logo, 'inline');
        	$cid = $this->email->attachment_cid($logo);
        	$message .= '<img src="cid:'. $cid .'" alt="photo1" />';


        	$this->email->message($message);
	 		$this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-'. $data['contrato']['numero'] .'.pdf');
	 
			

        	//Exclui o arquivo PDF da página
			unlink('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-'. $data['contrato']['numero'] .'.pdf');
			

	        //Envia o email e redireciona para a página
	        if($this->email->send())
	        {
	            $this->session->set_flashdata('msg','Contrato salvo e e-mail enviado com sucesso!');
	            redirect('propostas');
	        }
	        else
	        {
	            $this->session->set_flashdata('msg', 'Contrato salvo e e-mail não enviado! ERROR: '.$this->email->print_debugger());
	            redirect('propostas');
	        }

				
		}

	}