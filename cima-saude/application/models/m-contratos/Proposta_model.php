<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Proposta_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		//Função para inserir:
		//1. Uma nova proposta na tabela propostas;
		//2. Inserir os dependentes na tabela propostas_dependentes;
    //3. Inserir os agregados na tabela propostas_agregados;
    //4. Inserir os colaboradores na tabela propostas_colaboradores;
		function insert($data, $dependentes, $agregados, $colaboradores){
       		/*echo '<pre>';
            var_dump($dependentes[0]);
          echo '</pre>';
          echo '<pre>';
            var_dump($dependentes[1]);
          echo '</pre>';*/
          //var_dump($data, $dependentes, $agregados, $colaboradores, count($dependentes), count($agregados), count($colaboradores)); die;
      		$this->db->insert('propostas', $data);
     		
      		$lastRegisterId = $this->db->insert_id();
      		

          if($dependentes != ""){
        		for($i = 0; $i < count($dependentes); $i++){
        			$dependentes[$i]['fk_proposta'] = $lastRegisterId;

        			$this->db->insert('propostas_dependentes', $dependentes[$i]);
        		}
          }
          if($agregados != ""){
            for($i = 0; $i < count($agregados); $i++){
             $agregados[$i]['fk_proposta'] = $lastRegisterId;

             $this->db->insert('propostas_agregados', $agregados[$i]);
            }
          }
          if($colaboradores != ""){
            for($i = 0; $i < count($colaboradores); $i++){
              $colaboradores[$i]['fk_proposta'] = $lastRegisterId;


              $this->db->insert('propostas_colaboradores', $colaboradores[$i]);
            }
          }

          //*********************************************************************
          //***************** SALVANDO DADOS NA TABELA PESSOAS*******************
          //*********************************************************************
          if($dependentes != ""){
            for($i = 0; $i < count($dependentes); $i++){
              $dependentes[$i]['tipo'] = 'd';
              $dependentes[$i]['status'] = 'i';
              
              $this->db->insert('pessoas', $dependentes[$i]);
            }
          }
          if($agregados != ""){
            for($i = 0; $i < count($agregados); $i++){
             $agregados[$i]['tipo'] = 'a';
             $agregados[$i]['status'] = 'i';
             
             $this->db->insert('pessoas', $agregados[$i]);
            }
          }
          if($colaboradores != ""){
            for($i = 0; $i < count($colaboradores); $i++){
              $colaboradores[$i]['tipo'] = 'c';
               $colaboradores[$i]['status'] = 'i';
             

              $this->db->insert('pessoas', $colaboradores[$i]);
            }
          }          

      		

      		if($lastRegisterId){
       			return $lastRegisterId;
     		 }

      		else {
        		return false;
      		}
		}

    //Função para atualizar:
    //1. atualiza a proposta na tabela propostas;
    //2. Inserir os dependentes na tabela propostas_dependentes;
    //3. Inserir os agregados na tabela propostas_agregados;
    //4. Inserir os colaboradores na tabela propostas_colaboradores;
    function updateProposta($id, $data, $dependentes, $agregados, $colaboradores){
          /*echo '<pre>';
            var_dump($dependentes[0]);
          echo '</pre>';
          echo '<pre>';
            var_dump($dependentes[1]);
          echo '</pre>';*/
          //var_dump($data, $dependentes, $agregados, $colaboradores, count($dependentes), count($agregados), count($colaboradores)); die;
          
          $data['dt_alteracao'] = date("Y-m-d");
          $this->db->where("cod_proposta", $id);
          $result = $this->db->update("propostas", $data);
          

          if($dependentes != ""){
            for($i = 0; $i < count($dependentes); $i++){
              $dependentes[$i]['fk_proposta'] = $id;

              $this->db->insert('propostas_dependentes', $dependentes[$i]);
            }
          }
          if($agregados != ""){
            for($i = 0; $i < count($agregados); $i++){
             $agregados[$i]['fk_proposta'] = $id;

             $this->db->insert('propostas_agregados', $agregados[$i]);
            }
          }
          if($colaboradores != ""){
            for($i = 0; $i < count($colaboradores); $i++){
              $colaboradores[$i]['fk_proposta'] = $id;


              $this->db->insert('propostas_colaboradores', $colaboradores[$i]);
            }
          }
          

          if($id){
            return $id;
         }

          else {
            return false;
          }
    }

		//Função para ler o tipo de usuário e ler as permissões
		//1. Ler o tipo de usuário;
		//2. Ler as permissões
		function readDataAndPermission($id){

			//Leitura do tipo de usuário
			$this->db->select('*')->from('tipo_usuarios')->where('cod_tipo_usuario', $id);
      		$result = $this->db->get()->result();

      		
      		if($result){
            	foreach ($result as $resultado) {
              		$res[] = $this->toArray($resultado);
            	}
            	$data['tipo'] = $res[0];

            	//Leitura das permissões de acesso
            	$sql = 'SELECT user_permission.fk_permissao, user_permission.parametros FROM tipo_usuarios, user_permission WHERE tipo_usuarios.cod_tipo_usuario = ? and user_permission.fk_tipo_usuario = tipo_usuarios.cod_tipo_usuario';
      			//$query=$this->db->query($sql, array($cod_acesso));
      			$query = $this->db->query($sql, array($id));

      			$data['permission'] = $query->result_array();

      			//var_dump($data); die;
      			//var_dump($query->result_array()); die;
      			
      			//As duas buscas foram colocadas no vetor $data
      			return $data;

          	}
          	else {
            	return false;
          	}
		}

		function update($id, $data, $permission){
			$this->db->where('cod_tipo_usuario', $id);
      		$result = $this->db->update('tipo_usuarios', $data);
      		//var_dump($p); die;
      		if($result)
      			for($i = 1; $i <= count($permission); $i++){
	      			$p = array(
	      				'fk_tipo_usuario'  => $id,
	      				'fk_permissao' => $i,
	      				'parametros' => $permission[$i]);

	      			$this->db->where('fk_tipo_usuario', $id);
	      			$this->db->where('fk_permissao', $i);
	      			$res = $this->db->update('user_permission', $p);
      			}

      			var_dump($res);
      			return true;
      		return false;
		}

		function delete($id, $data, $permission){
			$this->db->where('cod_tipo_usuario', $id);
      		$result = $this->db->update('tipo_usuarios', $data);
      		//var_dump($p); die;
      		if($result)
      			for($i = 1; $i <= count($permission); $i++){
	      			$p = array(
	      				'fk_tipo_usuario'  => $id,
	      				'fk_permissao' => $i,
	      				'parametros' => $permission[$i]);

	      			$this->db->where('fk_tipo_usuario', $id);
	      			$this->db->where('fk_permissao', $i);
	      			$res = $this->db->update('user_permission', $p);
      			}

      			var_dump($res);
      			return true;
      		return false;
		}

		function deletePermissions($table, $campoId_tipo, $campoId_permission, $id_tipo, $id_permission){
			$this->db->where($campoId_tipo, $id_tipo);
			$this->db->where($campoId_permission, $id_permission);  
			$result = $this->db->delete($table);

			if($result)
      			return true;
      		return false;
		}

		function toArray($obj){
			$reaged = (array) $obj;
      		foreach($reaged as $key => &$field){
        		if(is_object($field))
        			$field = toArray($field);
    		}
      		return $reaged;
		}
		
	}

	
