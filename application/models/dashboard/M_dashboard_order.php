<?php
    class M_dashboard_order extends CI_Model {

        public function getOrderAll() {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->order_by('v.id_venta', 'DESC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getOrderAjaxWords($words) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->like('v.codigo_venta', $words['words'])
                     ->order_by('v.id_venta', 'DESC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getPendingOrder() {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.enviado', 'No')
                     ->order_by('v.id_venta', 'DESC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getDeliverOrder() {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.enviado', 'Si')
                     ->order_by('v.id_venta', 'DESC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }
    }
    
?>