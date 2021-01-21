<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
        $this->load->model('cart/M_cart');
        $this->load->library('dni');
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

    public function checkOutError($page_data) {
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

        $check_form = $this->checkDataUser($data);

        if( $check_form != false ) {
            $page_data['error_checkout'] = $check_form;
            $this->checkOutError($page_data);
        } else {
            //COMIENZO A INSERTAR EN LA BASE DE DATOS
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

                //Bajar el stock de los productos y asegurarse
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

    public function checkDataUser($data) {
        $cif = $data['cif'];
        $cif_other = $data['cif-other'];
        $check = true;
        //COMPROBACIONES ANTES DE INSERTAR EN LA BASE DE DATOS
        if( preg_match('/^[A-z]{2,25}$/', $data['name']) != 1 ) {
            $check = "El nombre de factura es demasiado largo.";

        } else if( isset($data['check-address']) && preg_match('/^[A-z]{2,25}$/', $data['name-other']) !=1 ) {
            $check = "El nombre de envío es demasiado largo.";

        } else if( preg_match('/^[A-z]{2,25}$/', $data['lname']) != 1 ) {
            $check = "El apellido de factura es demasiado largo.";

        } else if( isset($data['check-address']) && preg_match('/^[A-z]{2,25}$/', $data['lname-other']) !=1 ) {
            $check = "El apellido de envío es demasiado largo.";

        } else if( empty($cif) ) {
            $check = "El DNI de factura no es válido.";

        } else if( isset($data['check-address']) && empty($cif_other) ) {
            $check = "El DNI de envío no es válido.";

        }else if( $this->dni->typeDni($cif) == 'dni' && !$this->dni->isValidDni($cif) ) {
            $check = "El DNI de factura no es válido.";

        } else if( isset($data['check-address']) && $this->dni->typeDni($cif_other) == 'dni' && !$this->dni->isValidDni($cif_other) ) {
            $check = "El DNI de envío no es válido.";

        } else if( $this->dni->typeDni($cif) == 'nie' && !$this->dni->isValidNie($cif) ) {
            $check = "El NIE de factura no es válido.";

        }else if( isset($data['check-address']) && $this->dni->typeDni($cif_other) == 'nie' && !$this->dni->isValidNie($cif_other) ) {
            $check = "El NIE de envío no es válido.";

        } else if( $this->dni->typeDni($cif) == 'cif' && !$this->dni->isValidCif($cif) ) {
            $check = "El CIF de factura no es válido.";

        } else if( isset($data['check-address']) && $this->dni->typeDni($cif_other) == 'cif' && !$this->dni->isValidCif($cif_other) ) {
            $check = "El CIF de envío no es válido.";

        } else if( preg_match('/\S+@\S+\.\S+/', $data['email']) != 1 ) {
            $check = "El correo no es válido.";

        } else if( strlen($data['address']) < 1 || strlen($data['address']) > 50 ) {
            $check = "La dirección de factura no es válida.";

        } else if( isset($data['check-address']) && strlen($data['address-other']) < 1 || strlen($data['address-other']) > 50 ) {
            $check = "La dirección de envío no es válida.";

        } else if( preg_match('/^[0-9]{5}$/', $data['postal']) != 1 ) {
            $check = "El código postal de factura no es válido.";

        } else if( isset($data['check-address']) && preg_match('/^[0-9]{5}$/', $data['postal-other']) !=1 ) {
            $check = "El código postal de envío no es válido.";

        }  else if( strlen($data['city']) < 1 || strlen($data['city']) > 50 ) {
            $check = "La localidad de factura no es válida.";

        } else if( isset($data['check-address']) && strlen($data['city-other']) < 1 || strlen($data['city-other']) > 50 ) {
            $check = "La localidad de envío no es válida.";

        } else if( $data['phone'] != '' && preg_match('/^[0-9]{9}$/', $data['phone']) != 1 ) {
            $check = "El teléfono no es válido.";

        } else {
            $check = false;
        }

        return $check;
    }

    
}