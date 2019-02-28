<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/****************************************
****    FUNÇÕES: GENÉRICAS    ***********
*****************************************/
 
	if (!function_exists('formata_preco')){
		function formata_preco($valor){
		
			$negativo = false;
			$preco = "";
			$valor = intval(trim($valor));
			
			if ($valor < 0) {
				$negativo = true;
				$valor = abs($valor);
			}
			
			$valor = strrev($valor);
			
			while (strlen($valor) < 3) {
				$valor .= "0";
			}
			for ($i = 0; $i < strlen($valor); $i++) {
				if ($i == 2) {
					$preco .= ",";
				}
				if (($i <> 2) AND (($i+1)%3 == 0)) {
					$preco .= ".";
				}
				
				$preco .= substr($valor, $i , 1);
			}
			
			$preco = strrev($preco);
			
			return ($negativo ? "-" : "") . $preco;
		}
	}

	if (!function_exists('formata_preco_negativo')){
		function formata_preco_negativo($valor){
			
			$negativo = true;
			$preco = "";
			$valor = intval(trim($valor));
			
			if ($valor < 0) {
				$negativo = true;
				$valor = abs($valor);
			}
			
			$valor = strrev($valor);
			
			while (strlen($valor) < 3) {
				$valor .= "0";
			}
			for ($i = 0; $i < strlen($valor); $i++) {
				if ($i == 2) {
					$preco .= ",";
				}
				if (($i <> 2) AND (($i+1)%3 == 0)) {
					$preco .= ".";
				}
				
				$preco .= substr($valor, $i , 1);
			}
			
			$preco = strrev($preco);
			
			return ($negativo ? "-" : "") . $preco;
		}
	}

	if (!function_exists('formata_preco_db')){
		function formata_preco_db($valor){
			$valor = str_replace("R$" , "" , $valor );
			$valor = str_replace("." , "" , $valor ); // Primeiro tira os pontos
			$valor = str_replace("," , "" , $valor); // Depois tira a vírgula
			
			return $valor;
		}
	}

	if (!function_exists('formata_data_db')){
		function formata_data_db($data){
			$datas = explode("/", $data);
			$novaData = $datas[1] . '/' . $datas[0] .'/'. $datas[2]; 

			//var_dump($novaData);
			$time = strtotime($novaData);
			$newformat = date('Y-m-d', $time);
			//var_dump($newformat); die;
			return $newformat;
		}
	}

	if (!function_exists('formata_data_br')){
		function formata_data_br($data){
			//data está no formato aaaa-mm-dd
			//será passada para o formato dd/mm/aaaa

			$data = explode('-', $data);
			$data = $data[2] . '/' . $data[1] . '/' . $data[0]; 

			return $data;	
		}
	}

	if (!function_exists('formata_data_hora_br')){
		function formata_data_hora_br($data){
			//data está no formato aaaa-mm-dd
			//será passada para o formato dd/mm/aaaa
			$data = explode(' ', $data);
			$data[0] = explode('-', $data[0]);
			$data[0] = $data[0][2] . '/' . $data[0][1] . '/' . $data[0][0];

			$data = $data[0] . " " . $data[1];

			return $data;	
		}
	}

	if (!function_exists('dataContrato')){
		function dataContrato($cidade, $data_db){
			$data = explode('-', $data_db);
			$mes = $data[1];

			switch ($mes){
				case '01': $mes = "Janeiro"; break;
				case '02': $mes = "Fevereiro"; break;
				case '03': $mes = "Março"; break;
				case '04': $mes = "Abril"; break;
				case '05': $mes = "Maio"; break;
				case '06': $mes = "Junho"; break;
				case '07': $mes = "Julho"; break;
				case '08': $mes = "Agosto"; break;
				case '09': $mes = "Setembro"; break;
				case '10': $mes = "Outubro"; break;
				case '11': $mes = "Novembro"; break;
				case '12': $mes = "Dezembro"; break;
			}

			return $cidade . ', ' . $data[2] . ' de ' . $mes . ' de ' . $data[0] . '.';  
		}
	}

/**************************************************
****    FUNÇÕES: MÓDULO DE CONTRATOS    ***********
**************************************************/

	if (!function_exists('convertCodigoValidadePlanos')){
		function convertCodigoValidadePlanos($codigo){
			$meses = 0;
			switch ($codigo) {
				case '1':
					$meses = 6;
					break;
				case '2':
					$meses = 12;
					break;
				case '3':
					$meses = 24;
					break;
				case '4':
					$meses = 36;
					break;
				default:
					$meses = 0;
					break;
			}

			return $meses;	
		}
	}

	if (!function_exists('convertCodigoValidadePlanosAnos')){
		function convertCodigoValidadePlanosAnos($codigo){
			$tempo = '';
			switch ($codigo) {
				case '1':
					$tempo = '6 meses';
					break;
				case '2':
					$tempo = '1 ano';
					break;
				case '3':
					$tempo = '2 anos';
					break;
				case '4':
					$tempo = '3 anos';
					break;
				default:
					$tempo = '';
					break;
			}

			return $tempo;	
		}
	}

	if (!function_exists('convertTabelas')){
		function convertTabelas($codigo){
			$tabela = '';
			switch ($codigo) {
				case '1':
					$tabela = 'clientes';
					break;
				case '2':
					$tabela = 'propostas_dependentes';
					break;
				case '3':
					$tabela = 'propostas_agregados';
					break;
				case '4':
					$tabela = 'propostas_colaboradores';
					break;
				default:
					$tabela = '';
					break;
			}

			return $tabela;	
		}
	}

	if (!function_exists('convertId')){
		function convertId($codigo){
			$tabela = '';
			switch ($codigo) {
				case '1':
					$tabela = 'cod_cliente';
					break;
				case '2':
					$tabela = 'cod_dependente';
					break;
				case '3':
					$tabela = 'cod_agregado';
					break;
				case '4':
					$tabela = 'cod_colaboradore';
					break;
				default:
					$tabela = '';
					break;
			}

			return $tabela;	
		}
	}

	

	if (!function_exists('forma')){
		function forma($modo){
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
					return "Cortesia";

				case '':
					return "";
			}
		}
	}

	if (!function_exists('convertEstadoCivil')){
		function convertEstadoCivil($codigo){
			$estado = '';
			switch ($codigo) {
				case '1':
					$estado = 'SOLTEIRO(A)';
					break;
				case '2':
					$estado = 'CASADO(A)';
					break;
				case '3':
					$estado = 'UNIÃO ESTÁVEL';
					break;
				case '4':
					$estado = 'DIVORCIADO(A)';
					break;
				case '5':
					$estado = 'VIÚVO(A)';
					break;
				default:
					$estado = '';
					break;
			}

			return $estado;	
		}
	}

		if (!function_exists('convertGenero')){
		function convertGenero($codigo){
			$genero = '';
			switch ($codigo) {
				case '1':
					$genero = 'MASCULINO';
					break;
				case '2':
					$genero = 'FEMININO';
					break;
				case '3':
					$genero = 'OUTRO';
					break;
				default:
					$genero = '';
					break;
			}

			return $genero;	
		}

		if (!function_exists('meses_br')){
		function meses_br($mes){
			$mesBr = '';
			
			switch ($mes) {
				case '01':
					$mesBR = 'JANEIRO';
					break;
				case '02':
					$mesBR = 'FEVEREIRO';
					break;
				case '03':
					$mesBR = 'MARÇO';
					break;
				case '04':
					$mesBR = 'ABRIL';
					break;
				case '05':
					$mesBR = 'MAIO';
					break;
				case '06':
					$mesBR = 'JUNHO';
					break;
				case '07':
					$mesBR = 'JULHO';
					break;
				case '08':
					$mesBR = 'AGOSTO';
					break;
				case '09':
					$mesBR = 'SETEMBRO';
					break;
				case '10':
					$mesBR = 'OUTUBRO';
					break;
				case '11':
					$mesBR = 'NOVEMBRO';
					break;
				case '12':
					$mesBR = 'DEZEMBRO';
					break;
				default:
					$mesBR = '';
					break;
			}
			//var_dump($mesBR); die;
			return $mesBR;	
		}
	}

	}