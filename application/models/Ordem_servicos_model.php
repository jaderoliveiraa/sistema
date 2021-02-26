<?php

defined('BASEPATH') OR exit('Ação não permitida!');

class Ordem_servicos_model extends CI_Model {

    public function get_all() {

        $this->db->select([
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_nome',
            'marcas.marca_id',
            'marcas.marca_nome as marca',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');
        $this->db->join('marcas', 'marca_id = ordem_servico_marca_equipamento_id', 'LEFT');

        return $this->db->get('ordens_servicos')->result();
    }
    
    public function get_os_by_data() {

        $this->db->select([
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_nome',
            'marcas.marca_id',
            'marcas.marca_nome as marca',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');
        $this->db->join('marcas', 'marca_id = ordem_servico_marca_equipamento_id', 'LEFT');
        $this->db->where('ordem_servico_data_conclusao >=', date('Y-m-d'));
        //$this->db->where('ordem_servico_status' == 1);

        return $this->db->get('ordens_servicos')->result();
    }

    public function get_all_servicos_by_ordem($ordem_servico_id = NULL) {

        if ($ordem_servico_id) {

            $this->db->select([
                'ordem_tem_servicos.*',
                'servicos.servico_descricao'
            ]);

            $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
            $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
            return $this->db->get('ordem_tem_servicos')->result();
        }
    }

    public function delete_old_services($ordem_servico_id = NULL) {

        if ($ordem_servico_id) {

            $this->db->delete('ordem_tem_servicos', array('ordem_ts_id_ordem_servico' => $ordem_servico_id));
        }
    }

    public function get_by_id($ordem_servico_id = NULL) {

        $this->db->select([
            'ordens_servicos.*',
            'clientes.cliente_id',
            'clientes.cliente_cpf_cnpj',
            'clientes.cliente_celular',
            'situacoes.situacao_id',
            'situacoes.situacao_nome',
            'marcas.marca_id',
            'marcas.marca_nome',
            'CONCAT(clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
        ]);


        $this->db->where('ordem_servico_id', $ordem_servico_id);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
        $this->db->join('situacoes', 'situacao_id = ordem_servico_situacao_id', 'LEFT');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');
        $this->db->join('marcas', 'marca_id = ordem_servico_marca_equipamento_id', 'LEFT');

        return $this->db->get('ordens_servicos')->row();
    }

    public function get_all_servicos($ordem_servico_id = NULL) {

        if ($ordem_servico_id) {

            $this->db->select([
                'ordem_tem_servicos.*',
                'FORMAT(SUM(REPLACE(ordem_ts_valor_unitario,",", "")), 2) as ordem_ts_valor_unitario',
                'FORMAT(SUM(REPLACE(ordem_ts_valor_total,",", "")), 2) as ordem_ts_servico_valor_total',
                'servicos.servico_id',
                'servicos.servico_descricao',
                'servicos.servico_nome',
            ]);
            
            $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
            $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
            
            $this->db->group_by('ordem_ts_id_servico');
            
            return $this->db->get('ordem_tem_servicos')->result();
            
        }
    }
    
    public function get_valor_final_os($ordem_servico_id = NULL) {
        
        if($ordem_servico_id){
            $this->db->select([
                'FORMAT(SUM(REPLACE(ordem_ts_valor_total,",", "")), 2) as os_valor_total',
            ]);
            
            $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
            $this->db->where('ordem_ts_id_ordem_servico', $ordem_servico_id);
            
            return $this->db->get('ordem_tem_servicos')->row();
            
        }
        
    }
    
    /* Udilizados no relatório de os */

    public function gerar_relatorio_os($data_inicial = NULL, $data_final = NULL) {

        $this->db->select([
            'ordens_servicos.*',
            'clientes.cliente_id',
            'CONCAT(clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
            'formas_pagamentos.forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
//            'vendedores.vendedor_id',
//            'vendedores.vendedor_nome_completo',
        ]);

        $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
//        $this->db->join('vendedores', 'vendedor_id = ordem_servico_vendedor_id', 'LEFT');
        $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(ordem_servico_data_emissao, 1, 10) >= '$data_inicial' AND SUBSTR(ordem_servico_data_emissao, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(ordem_servico_data_emissao, 1, 10) >= '$data_inicial'");
        }

        return $this->db->get('ordens_servicos')->result();
    }

    public function get_valor_final_relatorio_os($data_inicial = NULL, $data_final = NUL) {

        $this->db->select([
            'FORMAT(SUM(REPLACE(ordem_servico_valor_total,",", "")), 2) as ordem_servico_valor_total',
        ]);

        if ($data_inicial && $data_final) {

            $this->db->where("SUBSTR(ordem_servico_data_emissao, 1, 10) >= '$data_inicial' AND SUBSTR(ordem_servico_data_emissao, 1, 10) <= '$data_final'");
        } else {
            $this->db->where("SUBSTR(ordem_servico_data_emissao, 1, 10) >= '$data_inicial'");
        }
        return $this->db->get('ordens_servicos')->row();
    }

    /* FIM Udilizados no relatório de os */

}
