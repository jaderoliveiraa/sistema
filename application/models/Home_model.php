<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Home_model extends CI_Model {

    public function get_sum_vendas() {

        $this->db->select([
            'FORMAT(SUM(REPLACE(venda_valor_total,",", "")), 2) as venda_valor_total',
        ]);

        return $this->db->get('vendas')->row();
    }
    
    public function get_sum_ordem_servico() {

        $this->db->select([
            'FORMAT(SUM(REPLACE(ordem_servico_valor_total,",", "")), 2) as ordem_servico_valor_total',
        ]);

        return $this->db->get('ordens_servico')->row();
    }
    
    public function get_sum_receber() {

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor,",", "")), 2) as conta_receber_valor',
        ]);
        
        $this->db->where('conta_receber_status', 0);

        return $this->db->get('contas_receber')->row();
    }
    
    public function get_sum_pagar() {

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor,",", "")), 2) as conta_pagar_valor',
        ]);
        $this->db->where('conta_pagar_status', 0);

        return $this->db->get('contas_pagar')->row();
    }
    
    public function get_contas_pagar_vencem_hoje() {

        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor',
        ]);
        $this->db->where('conta_pagar_status', 0);
        $this->db->where('conta_pagar_data_vencimento =', date('Y-m-d'));

        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->result();
    }

}
