<?php

/**
 * Categorias_contas_pagar_model
 *
 * Projeto:
 * 
 * @since 27/11/2014
 * @author Jhonatas C. Faria
 */
class Categorias_contas_pagar_model extends CI_Model {

    private $_table = "fn_categorias_contas_pagar";

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
		$this->db->select("{$this->_table}.*");
        if ($id) {
            $this->db->where($this->_table . ".id", $id);
        }else{
			$this->db->join('fn_centro_custo', "fn_centro_custo.id = {$this->_table}.custo_fixo",'left');
			$this->db->select("fn_centro_custo.nome as custo_fixo");
		}
        if ($nome) {
            $this->db->like("nome_categoria", $nome);
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
