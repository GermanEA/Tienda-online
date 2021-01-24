<?php
    class M_dashboard_invoice extends CI_Model {

        public function countAllInvoice() {
            return $this->db->count_all('factura');
        }

        public function getInvoicePages($limit, $start) {

            $select = 'id_factura AS ID, codigo_factura AS Código factura, cif AS DNI / NIE / CIF, email AS Email, localidad AS Localidad, telefono AS Teléfono';

            $query = $this->db->select($select)
                     ->from('factura')
                     ->order_by('id_factura', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function countAllShipping() {
            return $this->db->count_all('envio');
        }

        public function getShippingPages($limit, $start) {

            $select = 'id_envio AS ID, codigo_envio AS Código envío, cif AS DNI / NIE / CIF, email AS Email, localidad AS Localidad, telefono AS Teléfono';

            $query = $this->db->select($select)
                     ->from('envio')
                     ->order_by('id_envio', 'DESC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getSingleInvoice($id) {
            $select = 'f.*, v.fecha_pedido, v.total AS total_pedido, p.descripcion, vd.cantidad, vd.precio, vd.total, t.codigo_talla';

            $query = $this->db->select($select)
                     ->from('factura AS f')
                     ->join('envio AS e', 'f.id_factura = e.id_factura')
                     ->join('venta AS v', 'e.id_envio = v.id_envio')
                     ->join('venta_detalle as vd', 'v.id_venta = vd.id_venta')
                     ->join('producto AS p', 'vd.id_producto = p.id_producto')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->where('f.id_factura', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

        public function getSingleShipping($id) {
            $select = 'e.*, v.fecha_pedido, v.total AS total_pedido, p.descripcion, vd.cantidad, vd.precio, vd.total, t.codigo_talla';

            $query = $this->db->select($select)
                     ->from('envio AS e')
                     ->join('venta AS v', 'e.id_envio = v.id_envio')
                     ->join('venta_detalle as vd', 'v.id_venta = vd.id_venta')
                     ->join('producto AS p', 'vd.id_producto = p.id_producto')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->where('e.id_envio', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

}
?>