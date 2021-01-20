<?php if( $this->cart->total_items() != 0) { ?>
    <?php foreach( $this->cart->contents() as $row): ?>

        <div class="cart-row">
            <div class="left-wrapper">
                <img class="img-fluid" src="<?= base_url($row['image']); ?>" alt="<?= $row['name']; ?>">
            </div>
            <div class="center-wrapper">
                <span class="cart-product-name"><?= $row['name']; ?></span>
                <div class="options-wrapper">
                    <span>CANTIDAD: <?= $row['qty']; ?></span>

                    <?php if( !empty($row['size']) ) { ?>
                        <span>TALLA: <?= $row['size']; ?></span>
                    <?php }; ?>
                </div>
                
            </div>
            <div class="right-wrapper">
                <span><?= number_format( $row['price'], 2, ',', '.'); ?>€</span>
            </div>
        </div>        

    <?php endforeach; ?>

        <div class="cart-total-wrapper">        
            <a href="<?= base_url('cart/cart'); ?>">            
                <button class="btn btn-original btn-buy-modal">Ir al carrito</button>
            </a>
            <div class="cart-total">
                <span>Total (<?php if( $this->cart->total_items() <= 1 ) {
                        echo $this->cart->total_items() . ' producto';
                    } else {
                        echo $this->cart->total_items() . ' productos'; 
                    } ?>):
                </span>                    
                <span>
                    <strong><?= number_format($this->cart->total(), 2, ',', '.'); ?>€</strong>
                </span>
            </div>
        </div>

<?php } else { ?>
    <span>No hay productos en la cesta.</span>
<?php } ?>