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

        if( empty($data['size']) ) {
            $id_producto['id_producto'] = $data['id-producto'];
        } else {
            $id_producto = $this->M_cart->getIdTipoProductoSize($data['product-code'], $data['size']);
        }        

        $data_cart = array(
            'id'    => $data['id'],
            'qty'   => $data['qty'],
            'price' => $data['price'],
            'name'  => $data['name'],
            'size'  => $data['size'],
            'image' => $data['image'],
            'id_producto' => $id_producto['id_producto']
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
        $response = array();
        
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
                // CONTROLAR QUE NO EXISTA YA UN EMAIL ASOCIADO
                $user_check = $this->M_cart->getIdUser($data_insert['email']);
                if( $user_check == NULL) {
                    $response['insert-user'] = $this->M_cart->insertUserAnonimous($data_insert);
                }
            }

            $user = $this->M_cart->getIdUser($data_insert['email']);
            //Insertar el total de la venta
            $id_venta = $this->M_cart->insertVenta($data, $user['id_usuario'], $id_envio, $ship_cost);

            //Insertar los detalles de la venta por línea
            foreach( $this->cart->contents() as $row ){
                $response['insert-venta'] = $this->M_cart->insertVentaDetalle($row, $id_venta);
            }

            //Bajar el stock de los productos
            // foreach( $this->cart->contents() as $row ){
            //     $stock = $this->M_cart->getStock($row['id_producto']);
            //     $new_stock = $stock['stock'] - $row['qty'];
            //     $response['insert-stock'] = $this->M_cart->decreaseStock($row['id_producto'], $new_stock);
            // }

            //Vaciar el carrito
            $this->cart->destroy();

            $response['success'] = true;
            
        } else {
            $response['success'] = false;
        }

        $this->cartMessage($response);
    }

    public function cartMessage($response) {
        $page_data['page_content'] = 'cart/v_cart_response';
        $page_data['success'] = $response['success'];

        if( $response['success'] != true) {
            $page_data['message'] = 'Ha ocurrido algún error, inténtelo de nuevo.';
        } else if( $response['insert-venta'] != true ) {
            $page_data['message'] = 'No se ha podido completar la venta.';
        } else {
            $page_data['message'] = 'Su compra se ha realizado con éxito';
        }
		
        $this->load->view('/layouts/main', $page_data);
    }
}