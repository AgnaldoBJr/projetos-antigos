<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Generic_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function insert($table, $campoId, $data){
			//var_dump($data, "vai inserir                  ");
       
      $this->db->insert($table, $data);
     
      		$lastRegisterId = $this->db->insert_id();
      		
      	if($lastRegisterId){
       			return $this->toArray($this->readById($table, $campoId, $lastRegisterId));
     		}

      		else {
        		return false;
      		}
		}

		function readById($table, $campoId, $id){
			$this->db->select('*')->from($table)->where($campoId, $id);
      		$result = $this->db->get()->result();

      		if($result){
            foreach ($result as $resultado) {
              $res[] = $this->toArray($resultado);
            }
            return $res[0];
          }
          else {
            return false;
          }
		}

		function readAll($table){
			$this->db->select('*')->from($table);
      		$result = $this->db->get()->result();
          
          if($result){
      		  foreach ($result as $resultado) {
        		  $res[] = $this->toArray($resultado);
      		  }
         		return $res;
        	}
      		else {
        		return false;
      		}
    	}

      function readAllWhere($table, $campoId, $id){
      $this->db->select('*')->from($table)->where($campoId, $id);
          $result = $this->db->get()->result();
          
          if($result){
            foreach ($result as $resultado) {
              $res[] = $this->toArray($resultado);
            }
            return $res;
          }
          else {
            return false;
          }
      }

		function update($table, $campoId, $id, $data){
			$this->db->where($campoId, $id);
      		$result = $this->db->update($table, $data);

      		if($result)
      			return true;
      		return false;
		}

		function delete($table, $campoId, $id){
			$this->db->where($campoId, $id); 
			$result = $this->db->delete($table);

			if($result)
      			return true;
      		return false;
		}


		function readAndProjection($table, $camposDeProjecao){
			$this->db->select($camposDeProjecao)->from($table);
      		$result = $this->db->get()->result();
      
          if($result == null){
            return false;
          }
          
      		foreach ($result as $resultado) {
        		$res[] = $this->toArray($resultado);
      		}
      

      		if($res){
        		return $res;
        	}
      		else {
        		return false;
      		}
		}

    function readAndProjectionById($campos, $tables, $where){
      $sql = 'SELECT ' . $campos . ' FROM ' . $tables . ' WHERE ' . $where;


      $query = $this->db->query($sql);

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }

    function readAndProjectionManyTables($campos, $tables, $where){
      $sql = 'SELECT ' . $campos . ' FROM ' . $tables . ' WHERE ' . $where;


      $query = $this->db->query($sql);

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }

    function readAndProjectionOrderBy($campos, $tables, $where, $columns){
      $sql = 'SELECT ' . $campos . ' FROM ' . $tables . ' WHERE ' . $where . ' ORDER BY ' . $columns;
      $query = $this->db->query($sql);

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }

    function gerarRelatorio($tables, $campos, $where, $groupBy, $orderBy){

      $sql = 'SELECT ' . $campos . ' FROM ' . $tables;
      if($where != ''){
        $sql.= ' WHERE ' . $where;
      }
      //if($groupBy !=''){
        //$sql.= ' GROUP BY ' . $groupBy;
      //}

    
      $query = $this->db->query($sql);

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }


    function justQuery($sql){

      $query = $this->db->query($sql);

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }

		function toArray($obj){
			$reaged = (array) $obj;
      		foreach($reaged as $key => &$field){
        		if(is_object($field))
        			$field = toArray($field);
    		}
      		return $reaged;
		}

    function lastInsert($table, $campoId){

      $this->db->select_max($campoId);
      $result= $this->db->get($table)->row_array();
      return $result[$campoId];    
    }
	}