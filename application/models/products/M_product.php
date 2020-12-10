<?php
    class M_product extends CI_Model {

        public function getProduct($tipo_producto) {
            $result = $this->db->select('*')->from('producto')->where('tipo_producto', $tipo_producto);

            $query = $this->db->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
            
        } 
    }
    
?>