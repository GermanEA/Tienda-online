<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
        $this->load->model('cart/M_cart');
	}	

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'cart/v_cart';
		
        $this->load->view('/layouts/main', $page_data);
    }
    
    public function addCartProduct() {
        $data = $this->input->post();

        $data_cart = array(
            'id'    => $data['id'],
            'qty'   => $data['qty'],
            'price' => $data['price'],
            'name'  => $data['name'],
            'size'  => $data['size'],
            'image' => $data['image'],
            'id_producto' => $data['id-producto']
        );

        $this->cart->insert($data_cart);

        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<response>'.$this->cart->total_items().'</response>';
    }

    public function removeProduct() {
        $data = $this->input->post();

        $this->cart->remove($data['rowid']);
        $this->index();
    }

    public function showCartProduct() {
        $this->load->view('/cart/v_cart_modal');
    }

    public function checkOut() {
        $page_data['page_content'] = 'cart/v_cart_checkout';
        $page_data['custom_js'] = array(
			'/public/assets/js/checkout.js'
		);
        
        $page_data['gastos_envio'] = $this->calcShipCost();
		
        $this->load->view('/layouts/main', $page_data);
    }

    public function calcShipCost() {
        $ship_cost = 0;
        
        if( isset($this->cart) ) {            
            if( $this->cart->total() >= 50 ) {
                $ship_cost = 0;
            } else {
                $ship_cost = 10;
            }
        }

        return $ship_cost;
    }

    public function buyNow() {
        $data = $this->input->post();
        
        $data_insert = array(
            'name'    => $data['name'], 
            'lname'   => $data['lname'], 
            'cif'     => $data['cif'], 
            'address' => $data['address'], 
            'postal'  => $data['postal'],
            'city'    => $data['city'],  
            'phone'   => $data['phone'], 
            'email'   => $data['email']
        );

        if( isset( $this->cart) || $this->cart->total_items() != 0 ){
            $id_factura = $this->M_cart->insertFactura($data_insert);
            $id_envio = '';
            $ship_cost = $this->calcShipCost();

            if( isset($data['check-address'])) {
                $data_insert = array(
                    'name'    => $data['name-other'], 
                    'lname'   => $data['lname-other'], 
                    'cif'     => $data['cif-other'], 
                    'address' => $data['address-other'], 
                    'postal'  => $data['postal-other'],
                    'city'    => $data['city-other'],   
                    'phone'   => $data['phone'], 
                    'email'   => $data['email']
                );

                $id_envio = $this->M_cart->insertEnvio($data_insert, $id_factura);

            } else {
                $id_envio = $this->M_cart->insertEnvio($data_insert, $id_factura);
            }

            if( !isset( $this->session->logged ) || $this->session->logged == false ) {
                $this->M_cart->insertUserAnonimous($data_insert);
            }

            //Insertar el total de la venta
            $user = $this->M_cart->getIdUser($data_insert['email']);
            $id_venta = $this->M_cart->insertVenta($data, $user['id_usuario'], $id_envio, $ship_cost);

            //Insertar los detalles de la venta por línea
            foreach( $this->cart->contents() as $row ){
                $this->M_cart->insertVentaDetalle($row, $id_venta);
            }



        } else {
            echo 'Error carrito vacio';
        }
    }
}