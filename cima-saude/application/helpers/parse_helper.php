<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 	require('funcoes_helper.php');
	
	if (!function_exists('parsePessoa')){
		function parsePessoa($data, $id){
		//	var_dump($data); die;
			$parseData = array(
				'carteirinha' => ($data['carteirinha'] != null) ? $data['carteirinha'] : '',
				'fk_contrato' => ($data['fk_contrato'] != null) ? $data['fk_contrato'] : '',
				'tipo' => ($data['tipo'] != null) ? $data['tipo'] : 'n',
				'nome' => ($data['nome'] != null) ? $data['nome'] : '',
				'data_nasc' => ($data['data_nasc'] != null) ? formata_data_db($data['data_nasc']) : '',
				'cpf' => ($data['cpf'] != null) ? $data['cpf'] : '',
				'rg' => ($data['rg'] != null) ? $data['rg'] : '',
				'sexo' => ($data['sexo'] != null) ? $data['sexo'] : '',
				'estado_civil' => ($data['estado_civil'] != null) ? $data['estado_civil'] : '',
				'telefone' => ($data['telefone'] != null) ? $data['telefone'] : '',
				'celular' => ($data['celular'] != null) ? $data['celular'] : '',
				'email' => ($data['email'] != null) ? $data['email'] : '',
				'logradouro' => ($data['logradouro'] != null) ? $data['logradouro'] : '',
				'numero' => ($data['numero'] != null) ? $data['numero'] : '',
				'bairro' => ($data['bairro'] != null) ? $data['bairro'] : '',
				'complemento' => ($data['complemento'] != null) ? $data['complemento'] : '',
				'cidade' => ($data['cidade'] != null) ? $data['cidade'] : '',
				'estado' => ($data['estado'] != null) ? $data['estado'] : '',
				'cep' => ($data['cep'] != null) ? $data['cep'] : '',
				'status' => ($data['status'] != null) ? $data['status'] : 'i',
				'fk_acesso' => $id,
				'dt_cadastro' => date("Y-m-d H:i:s")
			);

			return $parseData;


		}

	}

	if (!function_exists('parseProposta')){
		function parseProposta($data, $id){
		//	var_dump($data); die;


			if($data['proposta-status'] == "Salvar proposta"){
				$data['proposta-status'] = '1';
			}
			if($data['proposta-status'] == "Gerar Contrato"){
				$data['proposta-status'] = '2';
			}
			if($data['proposta-status'] == "Avaliar"){
				$data['proposta-status'] = '3';
			}

			$parseData = array(
					'numero' => $data['numero_proposta'],
					'fk_cliente' => $data['cod_cliente'],
					'fk_plano' => $data['cod_plano'],
					'dt_contratacao' => formata_data_db($data['dt_contratacao']),
					//'dt_vencimento' => formata_data_db($data['dt_vencimento']),
					'pag_subtotal' => formata_preco_db($data['subtotal']),
					'pag_total' => formata_preco_db($data['total']),
					'pag_desconto' => str_replace("%" , "" ,$data['desconto']),
					'pag_modo_pagamento' => $data['cod_modo_pagamento'],
					'pag_qtd_parcelas' => $data['qtd_parcelas'],
					'pag_valor_parcelas' => formata_preco_db($data['valor_parcelas']),
					'pag_melhor_dia' => $data['melhor_dia'],
					'pag_texto' => $data['texto'],
					'observacoes' => $data['observacoes'],
					'status' => 'S',
					'pdf' => "Proposta-" . $data['numero_proposta'] . ".pdf",
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;


		}

	}

	if (!function_exists('parseIndicacao')){
		function parseIndicacao($indicacao){
					
			$data = array(
				'num_proposta' => $indicacao['numero_proposta'],
				'nome' => $indicacao['indicacao-nome'],
				'celular' =>  $indicacao['indicacao-celular']
				
			);
	
			//var_dump($data);die;
			return $data;
		}
	}
	

	if (!function_exists('tratarDadosPessoas')){
		function tratarDadosPessoas($nome, $dataN, $parentesco, $count, $tab){
			$data = array();
			for ($i = 0; $i < $count; $i++){
				$data[$i] = "";
				if($nome[$i] != ""){
					$data[$i] = array(
						'nome' => $nome[$i],
						'data_nasc' => formata_data_db($dataN[$i]),
						'parentesco' => $parentesco[$i],
						
					);
				}
			}
			//var_dump($data);die;
			return $data;
		}
	}


	if (!function_exists('tratarDadosColaboradores')){	
		function tratarDadosColaboradores($nome, $dataN, $count, $tab){
			$data = array();
			for ($i = 0; $i < $count; $i++){
				$data[$i] = "";
				if($nome[$i] != ""){
					$data[$i] = array(
						'nome' => $nome[$i],
						'data_nasc' => formata_data_db($dataN[$i]),
						
					);
				}
			}
			//var_dump($data);die;
			return $data;
		}
	}

	if (!function_exists('parseConta')){
		//Tipo: 1 - A vista; 2 - Parcelado
		function parseConta($data, $tipo, $parcela, $id, $vencimento){
			//$tipo == 1 : conta total
			if($tipo == 1){
				$parseData = array(
					'descricao' => $data['numero'],
					'fk_contrato' => $data['fk_contrato'],
					'fk_categoria' => '',
					'fk_centro_lucro' => '',
					'fk_cliente' => $data['fk_cliente'],
					'valor' => $data['pag_total'],
					'dt_recebimento' => date('Y-m-d', mktime(0, 0, 0, (date("m") + 1), date("d"), date("Y"))),
					'status' => '1',
					'observacoes' => '',
					'repetir' => '0',
					'qtd_repeticao' => '',
					'num_repeticao' => '',
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);
			}
			//$tipo == 2 : conta parcela
			else if($tipo == 2){
				$parseData = array(
					'descricao' => $data['numero'] . '-pc' . $parcela,
					'fk_contrato' => $data['fk_contrato'],
					'fk_categoria' => '',
					'fk_centro_lucro' => '',
					'fk_cliente' => $data['fk_cliente'],
					'valor' => $data['pag_valor_parcelas'],
					'dt_recebimento' => (($vencimento != 0) ? $vencimento : date('Y-m-d', mktime(0, 0, 0, (date("m") + $parcela), date("d"), date("Y"))) ),
					'status' => '1',
					'observacoes' => '',
					'repetir' => '1',
					'qtd_repeticao' => $data['pag_qtd_parcelas'],
					'num_repeticao' => $parcela,
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);
			}
			
			return $parseData;
		}
	}

	if (!function_exists('parseParceiro')){
		function parseParceiro($data, $id){
			$identificacao = '';
			if(isset($data['identificacao-crm'])){
				$identificacao = $data['identificacao-crm'] ;
			} else
			if(isset($data['identificacao-cro'])){
				$identificacao = $data['identificacao-cro'] ;
			} else
			if(isset($data['identificacao-coffito'])){
				$identificacao = $data['identificacao-coffito'] ;
			} else
			if(isset($data['identificacao-crp'])){
				$identificacao = $data['identificacao-crp'] ;
			} else
			if(isset($data['identificacao-cfn'])){
				$identificacao = $data['identificacao-cfn'] ;
			}
			

			//var_dump($identificacao); die;
			$parseData = array(
					'nome' => $data['nome'],
					'tipo' => $data['tipo'],
					'identificacao' => $identificacao,
					'cnpj' => (isset($data['cnpj']) ? $data['cnpj'] : '0'),
					'cpf' => (isset($data['cpf']) ? $data['cpf'] : '0'),
					'rg' => (isset($data['rg']) ? $data['rg'] : '0'),
					'logradouro' => $data['endereco-logradouro'],
					'numero' => $data['endereco-numero'],
					'bairro' => $data['endereco-bairro'],
					'complemento' => $data['endereco-complemento'],
					'cep' => $data['endereco-cep'],
					'cidade' => $data['endereco-cidade'],
					'estado' => $data['endereco-estado'],
					'telefone' => $data['telefone'],
					'celular' => $data['celular'],
					'email' => $data['email'],
					'nome_usuario' => $data['usuario'],
					'senha' => $data['senha'],
					
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;
		}
	}

	if (!function_exists('parseServico')){
		function parseServico($data, $id){
			$parseData = array(
					'fk_parceiro' => $data['parceiro'],
					'tipo' => $data['tipo'],
					'fk_exame' => $data['exame'],
					'nome' => $data['nome'],
					'valor_parceiro' => formata_preco_db($data['valor_parceiro']),
					'valor_cima' => formata_preco_db($data['valor_cima']),
					'valor_recibo' => formata_preco_db($data['valor_recibo']),
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);
			return $parseData;
		}
	}

	if (!function_exists('parseExame')){
		function parseExame($data, $id, $loginType){
			$parseData = array(		
					'nome' => $data['nome'],
					'descricao' => $data['descricao'],
					'fk_parceiro' => ($loginType == 1) ? 0 : $id,
					'fk_acesso' => ($loginType == 1) ? $id : 0,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;
		}
	}

	if (!function_exists('parseGuia')){
		function parseGuia($data, $id){

			//var_dump($data['dt_realizacao']);die;
			$parseData = array(		
					'fk_paciente' => $data['fk_paciente'],
					'fk_tabela' => $data['fk_tabela'],
					'dt_abertura' => formata_data_db($data['dt_abertura']),
					'dt_realizacao' => ($data['dt_realizacao'] == '') ? '' : formata_data_db($data['dt_realizacao']),
					'horario' => $data['horario'],
					'status' => ($data['dt_realizacao'] == '' && $data['horario'] == '') ? 'p' : 'c',
					'valor_guia' => '',
					'valor_tipo' => $data['pagamento'],
					'emissor' => 'CIMA SAÚDE',
					'fk_realizador' => $data['parceiro'],
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;
		}

		if (!function_exists('parseEspecialidade')){
		function parseEspecialidade($data, $id){
			$parseData = array(		
					'nome' => $data['nome'],
					'descricao' => $data['descricao'],
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d H:i:s")
				);

			return $parseData;
		}
	}

	if (!function_exists('parseFornecedor')){
		function parseFornecedor($data, $id){
			$parseData = array(
					'nome' => $data['nome'],
					'descricao' => $data['descricao'],
					'contato_telefone' => $data['telefone'],
					'contato_celular' => $data['celular'],
					'contato_email' => $data['email'],
					'observacoes' => $data['observacoes'],
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d")
				);
			return $parseData;
		}
	}

	if (!function_exists('parseConta2')){
		function parseConta2($data, $id){
			$parseData = array(		
					'nome' => $data['nome'],
					'descricao' => $data['descricao'],
					'fk_acesso' => $id,
					'dt_cadastro' => date("Y-m-d")
				);

			return $parseData;
		}
	}
}

	