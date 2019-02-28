<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class Dashboard extends CI_Controller {

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

		public function index(){
			$campo = 'cod_proposta';
			$table = 'propostas';
			$data['propostas_week'] = $this->Relatorio_model->countLastWeek($campo, $table);

			$campo = 'cod_proposta';
			$table = 'propostas';
			$data['propostas_month'] = $this->Relatorio_model->countLastMonth($campo, $table);

			$campo = 'cod_contrato';
			$table = 'contratos';
			$data['contratos_week'] = $this->Relatorio_model->countLastWeek($campo, $table);

			$campo = 'cod_contrato';
			$table = 'contratos';
			$data['contratos_month'] = $this->Relatorio_model->countLastMonth($campo, $table);


			$data['propostas_week'] = $data['propostas_week'][0]['quantidade'];
			$data['propostas_month'] = $data['propostas_month'][0]['quantidade'];
			$data['contratos_week'] = $data['contratos_week'][0]['quantidade'];
			$data['contratos_month'] = $data['contratos_month'][0]['quantidade'];


			$data['propostas_graph'] = $this->propostasData();
			$data['propostas_ultimas'] = $this->ultimasPropostas();
			$data['contas_contagem'] = $this->calcularContas();
			$data['total_contas'] = $this->totalContas();

			//var_dump($data['total_contas']); die;
			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/dashboard', $data);
		}

		public function propostasData(){
			$hoje = date('Y-m-d');
			$semana = date('w');
			$vSemana = '';

			switch ($semana) {
				case '0':
					$vSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
					$data1 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '1':
					$vSemana = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
					$data1 = date('Y-m-d', strtotime('-7 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '2':
					$vSemana = ['Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Segunda'];
					$data1 = date('Y-m-d', strtotime('-7 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '3':
					$vSemana = ['Quarta', 'Quinta', 'Sexta', 'Sábado', 'Segunda', 'Terça'];
					$data1 = date('Y-m-d', strtotime('-7 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '4':
					$vSemana = ['Quinta', 'Sexta', 'Sábado', 'Segunda', 'Terça', 'Quarta'];
					$data1 = date('Y-m-d', strtotime('-7 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '5':
					$vSemana = ['Sexta', 'Sábado', 'Segunda', 'Terça', 'Quarta', 'Quinta'];
					$data1 = date('Y-m-d', strtotime('-7 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;

				case '6':
					$vSemana = ['Sábado', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'];
					$data1 = date('Y-m-d', strtotime('-6 days', strtotime($hoje)));
					$data2 = date('Y-m-d', strtotime('-5 days', strtotime($hoje)));
					$data3 = date('Y-m-d', strtotime('-4 days', strtotime($hoje)));
					$data4 = date('Y-m-d', strtotime('-3 days', strtotime($hoje)));
					$data5 = date('Y-m-d', strtotime('-2 days', strtotime($hoje)));
					$data6 = date('Y-m-d', strtotime('-1 days', strtotime($hoje)));
					$vData = [$data1, $data2, $data3, $data4, $data5, $data6];
					break;
			}

			$data['semana'] = $vSemana;
			$data['date'] = $vData;
			$data['propostas'] = '';
			$data['contratos'] = '';
			$data['naoGanhas'] = '';

			for($i = 0; $i < 6; $i++){
				$query = 'SELECT COUNT(dt_contratacao) as num
						FROM propostas
						WHERE dt_contratacao = "' . $data['date'][$i] . '"';
				$result = $this->Generic_model->justQuery($query);
				$data['propostas'][$i] = $result[0]['num'];

				$query = 'SELECT COUNT(dt_contratacao) as num
						FROM contratos
						WHERE dt_contratacao = "' . $data['date'][$i] . '"';
				$result = $this->Generic_model->justQuery($query);
				$data['contratos'][$i] = $result[0]['num']; 
				
				$data['naoGanhas'][$i] = (int) $data['propostas'][$i] - (int)$data['contratos'][$i];

			}
			
			//var_dump($data); die;
			return $data;
		}

		public function ultimasPropostas(){
			$query = "SELECT numero, status, dt_cadastro  FROM propostas order by dt_cadastro desc limit 7";
			$result = $this->Generic_model->justQuery($query);

			for($i = 0; $i < count($result); $i++) {
				$result[$i]['dt_cadastro'] = substr($result[$i]['dt_cadastro'], 0, -3);
			}
			
			return $result;

		}

		public function calcularContas(){
			$data1 = date('Y-m-d');
			$data2 = date('Y-m-t');
			$data3 = date('Y-m-01', strtotime('+1 month', strtotime($data1)));
			$data4 = date('Y-m-t', strtotime('+1 month', strtotime($data1)));

			//var_dump($data1, $data2, $data3, $data4); die;
			$query = 'SELECT COUNT(cod_conta_a_pagar) as quantidade, SUM(valor) as valor
						FROM contas_a_pagar WHERE status = 1 AND dt_pagamento >= "'.$data1.'" AND dt_pagamento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['pagar_mes'] = $result[0];
			if($data['pagar_mes']['valor'] == null){
				$data['pagar_mes']['valor'] = '000';
			}

			$query = 'SELECT COUNT(cod_conta_a_pagar) as quantidade, SUM(valor) as valor
						FROM contas_a_pagar WHERE status = 1 AND dt_pagamento >= "'.$data3.'" AND dt_pagamento <= "' .$data4.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['pagar_proximo'] = $result[0];
			if($data['pagar_proximo']['valor'] == null){
				$data['pagar_proximo']['valor'] = '000';
			}





			$query = 'SELECT COUNT(cod_conta_a_receber) as quantidade, SUM(valor) as valor
						FROM contas_a_receber WHERE status = 1 AND dt_recebimento >= "'.$data1.'" AND dt_recebimento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['receber_mes'] = $result[0];
			if($data['receber_mes']['valor'] == null){
				$data['receber_mes']['valor'] = '000';
			}


			$query = 'SELECT COUNT(cod_conta_a_receber) as quantidade, SUM(valor) as valor
						FROM contas_a_receber WHERE status = 1 AND dt_recebimento >= "'.$data3.'" AND dt_recebimento <= "' .$data4.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['receber_proximo'] = $result[0];
			if($data['receber_proximo']['valor'] == null){
				$data['receber_proximo']['valor'] = '000';
			}

			//var_dump($data); die;
			return $data;
		}

		public function totalContas(){
			//$data1 = date('Y-m-d');
			//$data2 = date('Y-m-t');
			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_pagar;';

			$result = $this->Generic_model->justQuery($query);
			$data['pagar'] = $result[0]['valor'];

			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_receber;';

			$result = $this->Generic_model->justQuery($query);
			$data['receber'] = $result[0]['valor'];

			return $data;
		}

		public function relatorioDiario(){
			$hoje = date('Y-m-d');
			//Pessoas cadastradas hoje
			$query = 'SELECT COUNT(cod_cliente) as quantidade
						FROM clientes WHERE dt_cadastro = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['pessoas'] = $result[0]['quantidade'];
			//var_dump($result, $data['pessoas']); 
			

			//Propostas cadastradas hoje
			$query = 'SELECT COUNT(cod_proposta) as quantidade
						FROM propostas WHERE dt_contratacao = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['propostas'] = $result[0]['quantidade'];
			//var_dump($result, $data['propostas']); 
			

			//Contratos fechados hoje
			$query = 'SELECT COUNT(cod_contrato) as quantidade
						FROM contratos WHERE dt_contratacao = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['contratos'] = $result[0]['quantidade'];
			//var_dump($result, $data['contratos']);
			

			//Nome e Plano
			$query = 'SELECT contratos.*, clientes.nome as cliente_nome, planos.nome as plano_nome FROM contratos, planos, clientes WHERE contratos.fk_cliente = clientes.cod_cliente AND contratos.fk_plano = planos.cod_plano and dt_contratacao = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['contratos_lista'] = $result;
			//var_dump($result, $data['contratos_lista']); 

			//Indicações - listagem de nomes

			

			//FINANCEIRO
			//Contas pagas hoje - listagem e somatório
			$query = 'SELECT contas_a_pagar.*, fornecedores.nome as fornecedor_nome FROM contas_a_pagar, fornecedores WHERE contas_a_pagar.fk_fornecedor = fornecedores.cod_fornecedor AND dt_real = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_pagar_hoje'] = $result;
			//var_dump($result, $data['c_pagar_hoje']); die;

			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_pagar WHERE dt_real = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_pagar_hoje_total'] = ($result[0]['valor'] == null) ? 0 : $result[0]['valor'];
			//var_dump($result, $data['c_pagar_hoje_total']); die;


			//Contas recebidas hoje - listagem e somatório
			$query = 'SELECT contas_a_receber.*, clientes.nome as cliente_nome FROM contas_a_receber, clientes WHERE contas_a_receber.fk_cliente = clientes.cod_cliente AND dt_real = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_receber_hoje'] = $result;
			//var_dump($result, $data['c_pagar_hoje']); die;

			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_receber WHERE dt_real = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_receber_hoje_total'] = ($result[0]['valor'] == null) ? 0 : $result[0]['valor'];
			//var_dump($result, $data['c_receber_hoje_total']); die;


			//Saldo de movimentações diárias
			$data['movimentacoes']  = $data['c_receber_hoje_total'] - $data['c_pagar_hoje_total'];
			


			//Contas a pagar geradas hoje
			$query = 'SELECT contas_a_pagar.*, fornecedores.nome as fornecedor_nome FROM contas_a_pagar, fornecedores WHERE contas_a_pagar.fk_fornecedor = fornecedores.cod_fornecedor AND contas_a_pagar.dt_cadastro = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_pagar_cad'] = $result;
			//var_dump($result, $data['c_pagar_hoje']); die;

			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_pagar WHERE dt_cadastro = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_pagar_cad_total'] = ($result[0]['valor'] == null) ? 0 : $result[0]['valor'];
			//var_dump($result, $data['c_pagar_hoje_total']); die;


			//Contas a receber geradas hoje
			$query = 'SELECT contas_a_receber.*, clientes.nome as cliente_nome FROM contas_a_receber, clientes WHERE contas_a_receber.fk_cliente = clientes.cod_cliente AND contas_a_receber.dt_cadastro = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_receber_cad'] = $result;
			//var_dump($result, $data['c_pagar_hoje']); die;

			$query = 'SELECT SUM(valor) as valor
						FROM contas_a_receber WHERE dt_cadastro = "'.$hoje.'"';

			$result = $this->Generic_model->justQuery($query);

			$data['c_receber_cad_total'] = ($result[0]['valor'] == null) ? 0 : $result[0]['valor'];



			$mpdf = new mPDF();

				
				$html = $this->load->view('sistema/dashboard/template-relatorio-diario', $data, TRUE);
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
				$mpdf->Output('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\RelatorioDiario-'. date('dmY') .'.pdf' , 'F');
				


			//Enviando o PDF da proposta por email

	        $this->load->library('email');
	         
	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email
	        $config['mailtype'] = 'html';
	        
	        $this->email->initialize($config);
	        $destino = ['agnaldoburgojr@gmail.com', 'agnaldoburgojr@outlook.com'];
	        // Define remetente e destinatário
	        $this->email->from('noreply@cimasaude.com', 'Remetente'); // Remetente
	        $this->email->to($destino); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Relatório diário CIMA SAÚDE');
			//$logo = $this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg', 'inline');	 

			
	        /*
	         * Se o usuário escolheu o envio com template, passa o conteúdo do template para a mensagem
	         * caso contrário passa somente o conteúdo do campo 'mensagem'
	         */
	        //if(isset($dados['template']))
	        //    $this->email->message($this->load->view('contratos/propostas/email-templates',$dados, TRUE));
	        //else

	        $message = $msg . '<br><br>';
	        $message .='Atenciosamente, <br>CIMA SAÚDE<br><br>';
	        
	        
	        $logo = 'C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\assets\img\cima\logo-cima.jpg';
			$this->email->attach($logo, 'inline');
        	$cid = $this->email->attachment_cid($logo);
        	$message .= '<img src="cid:'. $cid .'" alt="photo1" />';


        	$this->email->message($message);
	 		$this->email->attach('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\RelatorioDiario-'. date('dmY') .'.pdf');
	 
			

        	//Exclui o arquivo PDF da página
			unlink('C:\xampp\aBurgoJrProjects\codeIgniterProjects\cima\cima-saude\pdf\Contrato-'. $data['contrato']['numero'] .'.pdf');
			

	        //Envia o email e redireciona para a página
	        if($this->email->send())
	        {
	            $this->session->set_flashdata('msg','Relatório diário enviado com sucesso!');
	            redirect('dashboard');
	        }
	        else
	        {
	            $this->session->set_flashdata('msg', 'Relatório diário não enviado! ERROR: '.$this->email->print_debugger());
	            redirect('dashboard');
	        }


		}

		public function demonstrativoMensal(){
			$d = date('Y-m-');
			$data['mes'] = meses_br(date('m'));
			//var_dump($data['mes']); die;
			
			$query = "SELECT * FROM demonstrativo WHERE demonstrativo.dt_real like '".$d."%' ORDER BY dt_real";
			$data['dataTable'] = $this->Generic_model->justQuery($query);
			 //var_dump($data); die;
			$pagar = 0;
			$receber = 0;
			for($i = 0; $i<count($data['dataTable']); $i++){
				if($data['dataTable'][$i]['id_table'] == '1'){
					$pagar += (int) $data['dataTable'][$i]['valor'];
				}
				else {
					$receber += (int) $data['dataTable'][$i]['valor'];
				}
			}
			$data['total'] = $receber - $pagar;
			if($data['total'] >= 0){
				$data['cor'] = 'blue';
			} else {
				$data['cor'] = 'red';
			}

			//Enviando os dados de quais são os últimos meses!
			$data['meses'] = $this->defineMeses();
			
			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/demonstrativo-mensal', $data);
		
		}
		
		public function demonstrativoSemanal(){
			$query = "SELECT * FROM demonstrativo WHERE dt_real BETWEEN CURRENT_DATE()-7 AND CURRENT_DATE()  ORDER BY dt_real";
			$data['dataTable']= $this->Generic_model->justQuery($query);

			$pagar = 0;
			$receber = 0;
			for($i = 0; $i<count($data['dataTable']); $i++){
				if($data['dataTable'][$i]['id_table'] == '1'){
					$pagar += (int) $data['dataTable'][$i]['valor'];
				}
				else {
					$receber += (int) $data['dataTable'][$i]['valor'];
				}
			}
			$data['total'] = $receber - $pagar;
			if($data['total'] >= 0){
				$data['cor'] = 'blue';
			} else {
				$data['cor'] = 'red';
			}

			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/demonstrativo-semanal', $data);
		}

		public function proximosLancamentos(){
			$query = "SELECT * FROM demonstrativo WHERE status = '1' AND data_prevista BETWEEN CURRENT_DATE() AND CURRENT_DATE() + INTERVAL 15 DAY ORDER BY data_prevista";
			
			$data['dataTable'] = $this->Generic_model->justQuery($query);



			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/proximos-lancamentos', $data);	
		}

		public function defineMeses(){
			$data = array('primeiro' => date('m'), 
						  'segundo'=>  date('m', strtotime('-1 months', strtotime(date('Y-m-d')))),
						  'terceiro' => date('m', strtotime('-2 months', strtotime(date('Y-m-d')))),
						  'quarto' => date('m', strtotime('-3 months', strtotime(date('Y-m-d')))),
						  'quinto' => date('m', strtotime('-4 months', strtotime(date('Y-m-d')))),
						  'sexto' => date('m', strtotime('-5 months', strtotime(date('Y-m-d')))));
			//var_dump($data); die;
			return $data;
		}

		public function demonstrativoMensalWithMonth($month){
			$d = date('Y-'. $month .'-');
			$data['mes'] = meses_br($month);
			//var_dump($data['mes']); die;
			
			$query = "SELECT * FROM demonstrativo WHERE demonstrativo.dt_real like '".$d."%' ORDER BY dt_real";
			$data['dataTable'] = $this->Generic_model->justQuery($query);
			 //var_dump($data); die;
			$pagar = 0;
			$receber = 0;
			for($i = 0; $i<count($data['dataTable']); $i++){
				if($data['dataTable'][$i]['id_table'] == '1'){
					$pagar += (int) $data['dataTable'][$i]['valor'];
				}
				else {
					$receber += (int) $data['dataTable'][$i]['valor'];
				}
			}
			$data['total'] = $receber - $pagar;
			if($data['total'] >= 0){
				$data['cor'] = 'blue';
			} else {
				$data['cor'] = 'red';
			}

			//Enviando os dados de quais são os últimos meses!
			$data['meses'] = $this->defineMeses();
			
			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/demonstrativo-mensal', $data);
		
		}

		public function contasReceber() {
			//echo "receber";


			$data1 = date('Y-m-d');
			$data2 = date('Y-m-t');
			$data3 = date('Y-m-01', strtotime('+1 month', strtotime($data1)));
			$data4 = date('Y-m-t', strtotime('+1 month', strtotime($data1)));

			$query = 'SELECT COUNT(cod_conta_a_receber) as quantidade, SUM(valor) as valor
						FROM contas_a_receber WHERE status = 1 AND dt_recebimento >= "'.$data1.'" AND dt_recebimento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['receber_mes'] = $result[0];
			if($data['receber_mes']['valor'] == null){
				$data['receber_mes']['valor'] = '000';
			}


			$query = 'SELECT COUNT(cod_conta_a_receber) as quantidade, SUM(valor) as valor
						FROM contas_a_receber WHERE status = 1 AND dt_recebimento >= "'.$data3.'" AND dt_recebimento <= "' .$data4.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['receber_proximo'] = $result[0];
			if($data['receber_proximo']['valor'] == null){
				$data['receber_proximo']['valor'] = '000';
			}

			$query = 'SELECT contas_a_receber.*, clientes.nome as nome FROM `contas_a_receber`, `clientes` WHERE contas_a_receber.fk_cliente = clientes.cod_cliente AND dt_recebimento >= "'.$data1.'" AND dt_recebimento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);
			$data['dataTable'] = $result;
			//echo "<pre>";
			//var_dump($data['receber_mes'], $data['receber_proximo'], $data['dataTable']);
			//echo "</pre>";
			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/receber-conta', $data);
		
		}	

		public function contasPagar() {
			//echo "pagar<br>";

			$data1 = date('Y-m-d');
			$data2 = date('Y-m-t');
			$data3 = date('Y-m-01', strtotime('+1 month', strtotime($data1)));
			$data4 = date('Y-m-t', strtotime('+1 month', strtotime($data1)));

			//var_dump($data1, $data2, $data3, $data4); die;
			$query = 'SELECT COUNT(cod_conta_a_pagar) as quantidade, SUM(valor) as valor
						FROM contas_a_pagar WHERE status = 1 AND dt_pagamento >= "'.$data1.'" AND dt_pagamento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['pagar_mes'] = $result[0];
			if($data['pagar_mes']['valor'] == null){
				$data['pagar_mes']['valor'] = '000';
			}

			$query = 'SELECT COUNT(cod_conta_a_pagar) as quantidade, SUM(valor) as valor
						FROM contas_a_pagar WHERE status = 1 AND dt_pagamento >= "'.$data3.'" AND dt_pagamento <= "' .$data4.'";';

			$result = $this->Generic_model->justQuery($query);

			$data['pagar_proximo'] = $result[0];
			if($data['pagar_proximo']['valor'] == null){
				$data['pagar_proximo']['valor'] = '000';
			}

			$query = 'SELECT * FROM contas_a_pagar WHERE dt_pagamento >= "'.$data1.'" AND dt_pagamento <= "' .$data2.'";';

			$result = $this->Generic_model->justQuery($query);
			$data['dataTable'] = $result;
			//echo "<pre>";
			//var_dump($data['pagar_mes'], $data['pagar_proximo'], $data['dataTable']);
			//echo "</pre>";
			$this->load->view('commons/sidebar');
			$this->load->view('sistema/dashboard/pagar-conta', $data);
		

		}

		public function statusReceber($status, $cod){
			$data = array('status' => $status, 'dt_real' => date('Y-m-d'));
			$table = 'contas_a_receber';
			$campoId = 'cod_conta_a_receber';
			$id = $cod;

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('dashboard/contas-receber');
      		}
		}

		public function statusPagar($status, $cod){
			$data = array('status' => $status, 'dt_real' => date('Y-m-d'));
			$table = 'contas_a_pagar';
			$campoId = 'cod_conta_a_pagar';
			$id = $cod;

			$resultado = $this->Generic_model->update($table, $campoId, $id, $data);

			if($resultado){
      			redirect('dashboard/contas-pagar');
      		}
		}

	}