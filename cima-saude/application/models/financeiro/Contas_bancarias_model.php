<?php

/**
 * Contas_bancarias_model
 *
 * Projeto:
 * 
 * @since 26/11/2014
 * @author Jhonatas C. Faria
 */
class Contas_bancarias_model extends CI_Model {

    private $_table = "fn_contas_bancarias";

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
        $this->db->select("*");
        $this->db->select("DATE_FORMAT(data_ultimo_saldo, '%d/%m/%Y') as data_ultimo_saldo");
        if ($id) {
            $this->db->where($this->_table . ".id", $id);
        }
        if ($nome) {
            $this->db->like("nome_conta", $nome);
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

    public function ultimo_saldo($id) {
        $this->db->where("id", $id);
        return $this->db->get($this->_table)->row()->saldo;
    }

    public function add_saldo($id, $valor) {
        $ultimo_saldo = $this->ultimo_saldo($id);
        $saldo_final = $ultimo_saldo + $valor;
        $this->db->flush_cache();

        $this->db->where("id", $id);
        return $this->db->update($this->_table, array('saldo' => $saldo_final));
    }

    public function remove_saldo($id, $valor) {
        $ultimo_saldo = $this->ultimo_saldo($id);
        $saldo_final = $ultimo_saldo - $valor;
        $this->db->flush_cache();

        $this->db->where("id", $id);
        return $this->db->update($this->_table, array('saldo' => $saldo_final));
    }

}
