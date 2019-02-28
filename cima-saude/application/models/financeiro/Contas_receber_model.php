<?php

/**
 * contas_receber_model
 *
 * Projeto:
 * 
 * @since 28/11/2014
 * @author Jhonatas C. Faria
 */
class Contas_receber_model extends CI_Model {

    private $_table = "fn_contas_receber";

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
        if ($this->db->update($this->_table, $form_data)) {
            return true;
        } else {
            throw new Exception("Erro ao salvar a conta - Controller: " . $this->uri->segment(2) . " Action: " . $this->uri->segment(3));
        }
    }

    /**
     * function find
     * 
     * @param int $id
     * @return object
     */
    public function find($id = null, $where = null) {
        $this->db->select("*");
        $this->db->select("DATE_FORMAT(data_vencimento, '%d/%m/%Y') as data_vencimento");
        if ($id) {
            $this->db->where($this->_table . ".id", $id);
        }

        if ($where) {
            $this->db->where($where);
        }
        return $this->db->get($this->_table);
    }

    /**
     * function find
     * 
     * @param int $id
     * @return object
     */
    public function find_join($id = null, $start = null, $end = null, $id_cliente = null, $id_categoria = null, $pago = null,$custo_fixo = null, $conta_bancaria = null) {
        $this->db->select("*");
        $this->db->select("$this->_table.id as id_conta");
        $this->db->select("clientes.nome as nome_cliente");
        $this->db->select("$this->_table.observacoes as observacoes_conta");
        $this->db->select("DATE_FORMAT(data_vencimento, '%d/%m/%Y') as data_vencimento");
        if ($id) {
            $this->db->where($this->_table . ".id", $id);
        }
		
		$pg = strtolower($this->input->post("pg")) == "true" ? '1' : '0';
		$npg = strtolower($this->input->post("npg")) == "true" ? '0' : '1';
		$this->db->where_in("{$this->_table}.pago",array($pg,$npg));
		
		$conta_bancaria = $this->input->post('conta_bancaria') != 'all' ? $this->input->post('conta_bancaria') : null;
		
        if ($id_cliente) {
            $this->db->where("clientes.id", $id_cliente);
        }

        if ($id_categoria) {
            $this->db->where("$this->_table.id_categoria", $id_categoria);
        }

        if ($pago != "") {
            $this->db->where("$this->_table.pago", $pago);
        }

        if ($start && $end) {
            $this->db->where("data_vencimento BETWEEN '$start' AND '$end'");
        }
        $this->db->join("fn_categorias_contas_receber", "$this->_table.id_categoria = fn_categorias_contas_receber.id");
		if ($custo_fixo != null) {
            $this->db->where("fn_categorias_contas_receber.custo_fixo", $custo_fixo);
        }
		if ($conta_bancaria) {
            $this->db->where("{$this->_table}.id_conta_bancaria", $conta_bancaria);
        }
        $this->db->join("clientes", "$this->_table.id_cliente = clientes.id");
        $this->db->order_by($this->_table . ".data_vencimento");
        return $this->db->get($this->_table);
    }

    /**
     * function find_group_by_categoria
     * 
     * Usado no demonstrativo financeiro
     * 
     * @return object
     */
    public function find_group_by_categoria($data_inicio, $data_fim) {
        $this->db->select("nome_categoria");
        $this->db->select("DATE_FORMAT(data_vencimento, '%d/%m/%Y') as data_vencimento");
        $this->db->select("SUM(valor) as valor_total");

        if ($data_inicio && $data_fim) {
            $this->db->where("data_vencimento BETWEEN '$data_inicio' AND '$data_fim'");
        }
        $this->db->join("fn_categorias_contas_receber", $this->_table . ".id_categoria = fn_categorias_contas_receber.id");
        $this->db->group_by("id_categoria");

        return $this->db->get($this->_table);
    }

    /**
     * function find_valor_total
     * 
     * Usado no demonstrativo financeiro - Exibe o valor total
     * 
     * @return object
     */
    public function find_valor_total($data_inicio, $data_fim) {
        $this->db->select("nome_categoria");
        $this->db->select("DATE_FORMAT(data_vencimento, '%d/%m/%Y') as data_vencimento");
        $this->db->select("SUM(valor) as valor_total");

        if ($data_inicio && $data_fim) {
            $this->db->where("data_vencimento BETWEEN '$data_inicio' AND '$data_fim'");
        }
        $this->db->join("fn_categorias_contas_receber", $this->_table . ".id_categoria = fn_categorias_contas_receber.id");

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
