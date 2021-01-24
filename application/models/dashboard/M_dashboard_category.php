<?php
    class M_dashboard_category extends CI_Model {

        public function getCategoryAll() {
            $query = $this->db->select('t.id_tipo_producto AS ID, t.tipo_producto AS Tipo producto, SUM(p.stock) AS Stock')
                     ->from('tipo_producto AS t')
                     ->join('producto AS p', 't.id_tipo_producto = p.id_tipo_producto')
                     ->group_by('t.tipo_producto')
                     ->order_by('t.id_tipo_producto', 'ASC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getCategoryLastOne() {
            $query = $this->db->select('id_tipo_producto AS ID, tipo_producto AS Tipo producto')
                     ->from('tipo_producto')
                     ->order_by('id_tipo_producto', 'ASC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->last_row('array');                
            } else {
                return NULL;
            }
        }

        public function getCategorySingle($id) {
            $query = $this->db->select('id_tipo_producto AS ID, tipo_producto AS Tipo producto')
                     ->from('tipo_producto')
                     ->where('id_tipo_producto', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function modifyCategory($data) {
            $data_update = array(
                'tipo_producto' => $data['tipo-producto']
            );

            $this->db->where('id_tipo_producto', $data['id'])
                     ->update('tipo_producto', $data_update);
        }

        // public function cancelCategory($id) {
        //     $this->db->where('id_tipo_producto', $id);
        //     $this->db->delete('tipo_producto');
        // }

        public function addCategory($data) {
            $data_insert = array(
                'id_tipo_producto' => $data['id'],
                'tipo_producto' => $data['tipo-producto']
            );

            $this->db->insert('tipo_producto', $data_insert);
        }
  
    }
?>