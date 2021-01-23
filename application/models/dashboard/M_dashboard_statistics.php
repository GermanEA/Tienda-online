<?php
    class M_dashboard_statistics extends CI_Model {

    public function salesMonth($dates) {
        $where = 'v.fecha_pedido BETWEEN ' . '"' . $dates["search-date-start"] . '"' . ' AND ' . '"' . $dates["search-date-end"] . '"';

        $query = $this->db->select('*')
                ->from('venta')
                ->where($where)
                ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->result_array();                
        } else {
            return NULL;
        }
    }

    public function updateChart() {
        $query = $this->db->select('*')
                ->from('venta')
                ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->result_array();                
        } else {
            return NULL;
        }
    }

    public function productChart() {
        $select = 'SUM(v.total) AS total, t.tipo_producto';

        $query = $this->db->select($select)
                ->from('venta_detalle AS v')
                ->join('producto AS p', 'v.id_producto = p.id_producto')
                ->join('tipo_producto AS t', 'p.id_tipo_producto = t.id_tipo_producto')
                ->group_by('t.id_tipo_producto')
                ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->result_array();                
        } else {
            return NULL;
        }
    }


} 

?>