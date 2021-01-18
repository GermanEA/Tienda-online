<div class="container container-checkout">
    <h2>CAJA</h2>
    <div class="checkout-wrapper">

        <?php if( $this->cart->total_items() === 0) { ?>
            <div class="checkout-empty">
                <span>No hay productos en la caja.</span>
            </div>
        <?php } else { ?>

            <div class="wrapper-left">
                <div class="data-wrapper">
                    <div class="title-wrapper">
                        <h3>Datos de facturación</h3>
                    </div>
                </div>
            </div>

            <div class="wrapper-right">
                <div class="cart-wrapper">
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


















            



        <?php } ?>

    </div>
</div>