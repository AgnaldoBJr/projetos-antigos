<?php
  if(!defined('BASEPATH')) exit('No direct script access allowed');

  class Acesso_model extends CI_Model{

    function __construct() {
      parent::__construct();
    }

    function readEmailDeAcesso($data)
    {
      $this->db->select('*')->from('acesso')->where('email', $data['email'])->limit(1);
      $results = $this->db->get()->result();
      return $results;
    }

    function readUsuarioDeAcesso($data)
    {
      $this->db->select('*')->from('parceiros')->where('nome_usuario', $data['email'])->limit(1);
      $results = $this->db->get()->result();
      return $results;
    }

    function readTipoUsuario(){

    }

    function readPermissoes(){

    }

    function loadPermissoes($codAcesso, $tipoUsuario){
      //var_dump($codAcesso, $tipoUsuario); 
     
      $sql = 'SELECT user_permission.fk_permissao, user_permission.parametros FROM acesso, tipo_usuarios, user_permission WHERE acesso.cod_acesso = ? and acesso.fk_tipo_usuario = tipo_usuarios.cod_tipo_usuario and tipo_usuarios.cod_tipo_usuario = user_permission.fk_tipo_usuario';
      //$query=$this->db->query($sql, array($cod_acesso));
      $query = $this->db->query($sql, array($codAcesso));

      //var_dump($query->result_array()); die;
      return $query->result_array(); 

    }
  }
