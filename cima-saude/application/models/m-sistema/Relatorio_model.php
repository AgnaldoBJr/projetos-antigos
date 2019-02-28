<?php
	if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Relatorio_model extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		
    function countLastWeek($campo, $table){

      $sql = 'SELECT COUNT(' . $campo . ') AS quantidade FROM '. $table . ' WHERE dt_contratacao between date_sub(now(), INTERVAL 1 WEEK) and now()';
      $query = $this->db->query($sql);

      //var_dump($query->result_array()); 
      return $query->result_array(); 

    }

    function countLastMonth($campo, $table){

      $sql = 'SELECT COUNT(' . $campo . ') AS quantidade FROM '. $table . ' WHERE dt_contratacao between date_sub(now(), INTERVAL 1 MONTH) and now()';
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