<?php
    class M_dashboard_order extends CI_Model {

        public function countAllOrders() {
            return $this->db->count_all('venta');
        }        

        public function getOrderPages($limit, $start) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getOrderSingle($id) {
            
            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.id_venta', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function getOrderDetails($id) {
            
            $select = 'venta.total as total_venta, venta.codigo_venta, producto.descripcion, venta_detalle.cantidad, venta_detalle.precio, venta_detalle.total, producto.imagen, talla.codigo_talla';

            $query = $this->db->select($select)
                     ->from('venta_detalle')
                     ->join('venta', 'venta_detalle.id_venta = venta.id_venta', 'inner')
                     ->join('producto', 'venta_detalle.id_producto = producto.id_producto', 'inner')
                     ->join('talla', 'producto.id_talla = talla.id_talla', 'left')
                     ->where('venta_detalle.id_venta', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

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

        public function getOrderAjaxWords($words, $limit, $start) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->like('v.codigo_venta', $words['words'])
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function countAllPending() {
            $this->db->where('enviado', 'No');
            $this->db->from('venta');
            return $this->db->count_all_results();
        }

        public function getPendingOrder($limit, $start) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.enviado', 'No')
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function changeSendPending($id_venta) {
            $date_send = date("Y-m-d");

            $data = array(
                'fecha_entrega' => $date_send,
                'enviado' => 'Si'
            );

            $this->db->where('id_venta', $id_venta)
                     ->update('venta', $data);
        }

        public function countAllDeliver() {
            $this->db->where('enviado', 'Si');
            $this->db->from('venta');
            return $this->db->count_all_results();
        }

        public function getDeliverOrder($limit, $start) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.enviado', 'Si')
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function countAllCancel() {
            $this->db->where('enviado', 'Anulado');
            $this->db->from('venta');
            return $this->db->count_all_results();
        }

        public function getCancelOrder($limit, $start) {

            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where('v.enviado', 'Anulado')
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function countOrdersDate($dates) {
            $where = 'fecha_pedido BETWEEN ' . '"' . $dates["search-date-start"] . '"' . ' AND ' . '"' . $dates["search-date-end"] . '"';

            $this->db->where($where);
            $this->db->from('venta');
            return $this->db->count_all_results();
        }

        public function getOrderAjaxDate($dates, $limit, $start) {
            $select = 'v.id_venta AS ID, v.codigo_venta AS Código, v.fecha_pedido AS Fecha pedido, v.fecha_confirmacion AS Fecha confirmación, v.fecha_entrega AS Fecha entrega, v.enviado AS Enviado, v.total AS Total pedido, u.email AS Correo usuario';

            $where = 'v.fecha_pedido BETWEEN ' . '"' . $dates["search-date-start"] . '"' . ' AND ' . '"' . $dates["search-date-end"] . '"';

            $query = $this->db->select($select)
                     ->from('venta AS v')
                     ->join('usuario AS u', 'v.id_usuario = u.id_usuario')
                     ->where($where)
                     ->order_by('v.id_venta', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function modifyOrder($data) {
            $data_update = array(
                'fecha_pedido' => $data['fecha-pedido'],
                'fecha_confirmacion' => $data['fecha-confirmacion'],
                'fecha_entrega' => $data['fecha-entrega'],
                'enviado' => $data['enviado'],
                'total' => $data['total-pedido']
            );

            $this->db->where('id_venta', $data['id'])
                     ->update('venta', $data_update);
        }

        public function cancelOrder($id) {
            $data = array(
                'enviado' => 'Anulado'
            );

            $this->db->where('id_venta', $id)
                     ->update('venta', $data);
        }
    }
    
?>