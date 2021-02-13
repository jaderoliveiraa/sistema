<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fluxo
 *
 * @author falec
 */
class Fluxo_Model extends CI_Model{
    
     public function get_contas_pagar_vencem_hoje() {

        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor',
        ]);
        $this->db->where('conta_pagar_status', 1);
        $this->db->where('conta_pagar_data_vencimento =', date('Y-m-d'));

        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->row();
    }
    
    public function get_contas_receber_vencem_hoje() {

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'CONCAT(clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
        ]);
        $this->db->where('conta_receber_status', 0);
        $this->db->where('conta_receber_data_vencimento =', date('Y-m-d'));

        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT');
        return $this->db->get('contas_receber')->row();
//        return $this->db->get('contas_receber')->result();
    }
    
}
