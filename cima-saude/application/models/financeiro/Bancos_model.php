<?php

/**
 * Bancos_model
 *
 * Projeto:
 * 
 * @since 25/11/2014
 * @author Jhonatas C. Faria
 */
class Bancos_model extends CI_Model {

    private $_table = "fn_bancos";

    /**
     * function save
     * 
     * @param Array $form_data
     * @return mixed
     */
    public function save($form_data) {
        $this->db->insert($this->_table, $form_data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * function edit
     * 
     * @param array $form_data
     * @param int $id
     * @return boolean
     */
    public function update($form_data, $id) {
        $this->db->where("id", $id);
        return $this->db->update($this->_table, $form_data);
    }

    /**
     * function find
     * 
     * @param int $id
     * @return object
     */
    public function find($id = '', $nome = null) {
        if ($id) {
            $this->db->where($this->_table . ".id", $id);
        }
        if($nome){
            $this->db->like("nome_banco", $nome);
        }
        return $this->db->get($this->_table);
    }

    /**
     * function delete
     * 
     * @param int $id
     * @return mixed
     */
    public function remove($id) {
        return $this->db->delete($this->_table, array("id" => $id));
    }

}
