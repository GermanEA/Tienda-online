<?php
    class M_product extends CI_Model {

        public function getProduct($id_tipo_producto) {
            $query = $this->db->select('producto.precio, producto.descripcion, producto.imagen, producto.codigo_producto, producto.id_tipo_producto')
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

        public function getProductSingle($codigo_producto) {
            $query = $this->db->select('*')
                     ->from('producto')
                     ->where('codigo_producto', $codigo_producto)
                    //  ->group_by('codigo_producto')
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

        public function getProductAjax($listFilters) {
            $this->db->select('producto.precio, producto.descripcion, producto.imagen, producto.codigo_producto, tipo_producto.tipo_producto, tipo_producto.id_tipo_producto');
            $this->db->from('producto');
            $this->db->join('talla', 'producto.id_talla = talla.id_talla', 'left');
            $this->db->join('tipo_producto', 'producto.id_tipo_producto = tipo_producto.id_tipo_producto', 'inner');
            
            $filtersTrue = array();
            $names = array('Frank', 'Todd', 'James');

            foreach( $listFilters as $filter => $value) {
                
                if( $value === "true" ){
                    array_push( $filtersTrue, $filter);                    
                }
            }

            if( !empty($filtersTrue) ) {
                $this->db->where_in('tipo_producto', $filtersTrue);
            }

            $this->db->group_by('codigo_producto');
            $this->db->order_by('id_tipo_producto');
            $query = $this->db->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }

        }

        public function getProductAjaxWords($words) {
            $query = $this->db->select('producto.precio, producto.descripcion, producto.imagen, producto.codigo_producto')
                     ->from('producto')
                     ->like('descripcion', $words['words'])
                     ->group_by('codigo_producto')
                     ->order_by('id_tipo_producto')
                     ->limit(10)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }
    }
    
?>