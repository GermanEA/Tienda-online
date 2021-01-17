<?php
    class M_dashboard_sizes extends CI_Model {

        public function getSizesAll() {
            $query = $this->db->select('id_talla AS ID, codigo_talla AS Código talla')
                     ->from('talla')
                     ->order_by('id_talla', 'ASC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getSizesLastOne() {
            $query = $this->db->select('id_talla AS ID, codigo_talla AS Código talla')
                     ->from('talla')
                     ->order_by('id_talla', 'ASC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->last_row('array');                
            } else {
                return NULL;
            }
        }

        public function getSizesSingle($id) {
            $query = $this->db->select('id_talla AS ID, codigo_talla AS Código talla')
                     ->from('talla')
                     ->where('id_talla', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function modifySize($data) {
            $data_update = array(
                'codigo_talla' => $data['codigo-talla']
            );

            $this->db->where('id_talla', $data['id'])
                     ->update('talla', $data_update);
        }

        // public function cancelSize($id) {
        //     $this->db->where('id_talla', $id);
        //     $this->db->delete('talla');
        // }

        public function addSize($data) {
            $data_insert = array(
                'id_talla' => $data['id'],
                'codigo_talla' => $data['codigo-talla']
            );

            $this->db->insert('talla', $data_insert);
        }
  
    }
?>