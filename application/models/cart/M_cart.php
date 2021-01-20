<?php
    class M_cart extends CI_Model {

    public function insertFactura($data) {
        $date = date('Y');
        $id_factura = $this->getIdFactura();

        if( $id_factura != NULL) {
            $id_factura = $id_factura['id_factura'] + 1;
        } else {
            $id_factura = 1;
        }

        $data_insert = array(
            'codigo_factura' => 'F-' . $date . '-' . $id_factura,
            'nombre'         => $data['name'], 
            'apellido'       => $data['lname'], 
            'cif'            => $data['cif'], 
            'direccion'      => $data['address'], 
            'codigo_postal'  => $data['postal'],
            'localidad'      => $data['city'],  
            'telefono'       => $data['phone'], 
            'email'          => $data['email']
        );

        $this->db->insert('factura', $data_insert); 
        
        return $id_factura;
    }

    public function insertEnvio($data, $id_factura) {
        $date = date('Y');
        $id_envio = $this->getIdEnvio();

        if( $id_envio != NULL) {
            $id_envio = $id_envio['id_envio'] + 1;
        } else {
            $id_envio = 1;
        }

        $data_insert = array(
            'codigo_envio'   => 'E-' . $date . '-' . $id_envio,
            'nombre'         => $data['name'], 
            'apellido'       => $data['lname'], 
            'cif'            => $data['cif'], 
            'direccion'      => $data['address'], 
            'codigo_postal'  => $data['postal'],
            'localidad'      => $data['city'],  
            'telefono'       => $data['phone'], 
            'email'          => $data['email'],
            'id_factura'     => $id_factura
        );

        $this->db->insert('envio', $data_insert);

        return $id_envio;
    }
    
    public function insertVenta($cart, $id_usuario, $id_envio, $ship_cost) {
        $date = date('Y-m-d');
        $dateY = date('Y');
        $id_venta = $this->getIdVenta();
        $total = $this->cart->total() + $ship_cost;

        if( $id_venta != NULL) {
            $id_venta = $id_venta['id_venta'] + 1;
        } else {
            $id_venta = 1;
        }

        $data_insert = array(
            'codigo_venta' => 'V-' . $dateY . '-' . $id_venta,
            'fecha_pedido' => $date,
            'id_usuario' => $id_usuario,
            'id_envio' => $id_envio,
            'enviado' => 'No',
            'total' => $total,

        );

        $this->db->insert('venta', $data_insert);

        return $id_venta;
    }

    public function insertVentaDetalle($item, $id_venta) {
        var_dump($item);

        $data_insert = array(
            'id_venta' => $id_venta,
            'id_producto' => $item['id_producto'],
            'cantidad' => $item['qty'],
            'precio' => $item['price'],
            'total' => $item['subtotal']
        );

        $this->db->insert('venta_detalle', $data_insert);
    }

    public function getIdEnvio() {
        $query = $this->db->select('*')
                 ->from('envio')
                 ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->last_row('array');                
        } else {
            return NULL;
        }
    }

    public function getIdFactura() {
        $query = $this->db->select('*')
                 ->from('factura')
                 ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->last_row('array');                
        } else {
            return NULL;
        }
    }

    public function getIdVenta() {
        $query = $this->db->select('*')
                 ->from('venta')
                 ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->last_row('array');                
        } else {
            return NULL;
        }
    }

    public function insertUserAnonimous() {
        $data = $this->input->post();

        $data_insert = array(
            'nombre'          => $data['name'],
            'apellido'        => $data['lname'],
            'cif'             => strtoupper($data['cif']),
            'direccion'       => $data['address'],
            'codigo_postal'   => $data['postal'],
            'localidad'       => $data['city'],
            'telefono'        => $data['phone'],
            'email'           => $data['email'],
            'id_tipo_usuario' => 3
        );
        
        $this->db->insert('usuario', $data_insert);
    }

    public function getIdUser($email) {
        $query = $this->db->select('id_usuario')
                     ->from('usuario')
                     ->where("email", $email)
                     ->get();

        if ( $query->num_rows() > 0 ) {
            return $query->row_array();                
        } else {
            return NULL;
        }
    }

}