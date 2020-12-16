<?php
    class M_product extends CI_Model {

        public function getProduct($id_tipo_producto) {
            $query = $this->db->select('producto.precio, producto.descripcion, producto.imagen, producto.codigo_producto')
                     ->from('producto')
                     ->where('id_tipo_producto', $id_tipo_producto)
                     ->group_by('codigo_producto')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }            
        }

        public function getProductSize($id_tipo_producto) {
            $query = $this->db->select('producto.codigo_producto, talla.codigo_talla')
                     ->from('producto')
                     ->join('talla', 'producto.id_talla = talla.id_talla', 'inner')
                     ->where('id_tipo_producto', $id_tipo_producto)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            } 
        }
        
        public function getProductListFilter() {
            $query = $this->db->select('*')
                     ->from('tipo_producto')
                     ->order_by('id_tipo_producto')
                     ->get();            

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }
    }
    
?>