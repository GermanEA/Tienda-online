<?php
    class M_user_orders extends CI_Model {

        public function getOrders() {
            $query = $this->db->select('*')
                    ->from('venta')
                    ->where('id_usuario', $_SESSION['id_usuario'])
                    ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

        public function getOrderDetails($id_venta) {
            $query = $this->db->select('venta.total as total_venta, venta.codigo_venta, producto.descripcion, venta_detalle.cantidad, venta_detalle.precio, venta_detalle.total, producto.imagen, talla.codigo_talla')
                     ->from('venta_detalle')
                     ->join('venta', 'venta_detalle.id_venta = venta.id_venta', 'inner')
                     ->join('producto', 'venta_detalle.id_producto = producto.id_producto', 'inner')
                     ->join('talla', 'producto.id_talla = talla.id_talla', 'left')
                     ->where('venta_detalle.id_venta', $id_venta)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }
    }
    
?>