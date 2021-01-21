<div class="container container-checkout">
    <h2>CAJA</h2>
    <form action="<?= base_url('/cart/cart/buyNow'); ?>" method="post" onsubmit="return validateForm()" name="formShop">
        <div class="checkout-wrapper">
            
            <?php if( $this->cart->total_items() === 0) { ?>
                <div class="order-wrapper">
                    <div class="checkout-empty">
                        <span>No hay productos en la caja.</span>
                    </div>
                </div>
            <?php } else { ?>

                <div class="order-wrapper">
                    <div class="wrapper-left">
                        <div class="data-wrapper">
                            <div class="inside-wrapper">
                                <div class="title-wrapper">
                                    <h3 id="title-bill">Datos de facturación</h3>
                                </div>
                                <div class="form-group">
                                    <?php if( isset($this->session->logged) && $this->session->logged == true ) { ?>

                                        <input type="text" class="form-control" name="cif" value="<?= $this->session->cif; ?>" readonly>
                                        <div>
                                            <input type="text" class="form-control" name="name" value="<?= $this->session->nombre; ?>" readonly>
                                            <input type="text" class="form-control" name="lname" value="<?= $this->session->apellido; ?>" readonly>
                                        </div>
                                        <input type="text" class="form-control" name="address" value="<?= $this->session->direccion; ?>" readonly>
                                        <div>
                                            <input type="text" class="form-control" name="postal" value="<?= $this->session->codigo_postal; ?>" readonly>
                                            <input type="text" class="form-control" name="city" value="<?= $this->session->localidad; ?>" readonly>
                                        </div>  

                                    <?php } else { ?>

                                        <input type="text" class="form-control" name="cif" placeholder="Empresa - NIF / CIF (opcional)">
                                        <div>
                                            <input type="text" class="form-control" name="name" placeholder="Nombre">
                                            <input type="text" class="form-control" name="lname" placeholder="Apellidos">
                                        </div>
                                        <input type="text" class="form-control" name="address" placeholder="Calle y Nº">
                                        <div>
                                            <input type="text" class="form-control" name="postal" placeholder="Código postal">
                                            <input type="text" class="form-control" name="city" placeholder="Localidad">
                                        </div>     

                                    <?php } ?>
                                </div>
                            </div>
                            <div class="data-footer">
                                <label class="form-check b-contain">
                                    <span class="form-check-label" for="other-address">¿Desea el envío a otra dirección?</span>
                                    <input class="form-check-input" type="checkbox" value="true" id="other-address" name="check-address">
                                    <div class="b-input"></div>
                                </label>
                            </div>
                        </div>

                        <div id="new-address" class="data-wrapper new-address">
                            <div class="inside-wrapper">
                                <div class="title-wrapper">
                                    <h3>Dirección de envío</h3>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="cif-other" placeholder="Empresa - NIF / CIF (opcional)">
                                    <div>
                                        <input type="text" class="form-control" name="name-other" placeholder="Nombre">
                                        <input type="text" class="form-control" name="lname-other" placeholder="Apellidos">
                                    </div>
                                    <input type="text" class="form-control" name="address-other" placeholder="Calle y Nº">
                                    <div>
                                        <input type="text" class="form-control" name="postal-other" placeholder="Código postal">
                                        <input type="text" class="form-control" name="city-other" placeholder="Localidad">
                                    </div>                    
                                </div>
                            </div>
                        </div>

                        <div class="data-wrapper">
                            <div class="inside-wrapper">
                                <div class="title-wrapper">
                                    <h3>E-mail y teléfono</h3>
                                </div>
                                <div class="form-group">
                                <?php if( isset($this->session->logged) && $this->session->logged == true ) { ?>

                                    <input type="email" class="form-control" name="email" value="<?= $this->session->email; ?>" readonly>
                                    <input type="text" class="form-control" name="phone" value="<?= $this->session->telefono; ?>">

                                <?php } else { ?>
                                    
                                    <input type="email" class="form-control" name="email" placeholder="Dirección e-mail">
                                    <input type="text" class="form-control" name="phone" placeholder="Número de teléfono (opcional)">

                                <?php } ?>
                                </div>
                            </div>
                            <div class="data-footer">
                                <span>Con su número de teléfono podemos contactarle en caso de surgir dudas o problemas.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="wrapper-right">
                        <div class="cart-wrapper">
                            <div class="inside-wrapper">
                                <div class="title-wrapper">
                                    <h3>Cesta de compras</h3>
                                    <a href="<?= base_url('cart/cart'); ?>">Editar</a>
                                </div>
        
                            <?php foreach( $this->cart->contents() as $row): ?>    
                                
                                <div class="product-wrapper">
                                    <div class="details-wrapper">
                                        <span><?= $row['qty'] . 'x ' . $row['name']; ?></span>
                
                                        <?php if( !empty($row['size']) ) { ?>
                                            <span><?= '(' . $row['size'] . ')'; ?></span>
                                            <?php }; ?>                            
                                    </div>    
                                    <div class="price-wrapper">                        
                                        <span><?= number_format( $row['price'] * $row['qty'], 2, ',', '.'); ?> €</span>
                                    </div>
                                </div>
        
                            <?php endforeach; ?>
                            
                                <div class="product-wrapper">
                                    <div class="details-wrapper">
                                        <span>Gastos de envío</span>                           
                                    </div>    
                                    <div class="price-wrapper">                
                                        <span><?= number_format($gastos_envio, 2, ',', '.'); ?> €</span>
                                    </div>
                                </div>
                            
                                <div class="total-wrapper">
                                    <div class="title-wrapper">
                                        <h3>Suma</h3>
                                        <span>Todos los precios incluyen IVA.</span>
                                    </div>
                                    <div class="total-num">
                                        <span><?= number_format($this->cart->total() + $gastos_envio, 2, ',', '.'); ?> €</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="data-wrapper">
                            <div class="inside-wrapper">
                                <div class="title-wrapper">
                                    <h3>Modo de pago</h3>
                                </div>
                                <div>
                                    <span>Sin plataforma de pago, se implementará cuando esté disponible.</span>
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>

                <div class="btn-order-wrapper text-center">
                    <button type="submit" class="btn btn-original btn-order" name="btn-order">Comprar ahora</button>
                </div>
            <?php } ?>
        </div>
    </form>
</div>