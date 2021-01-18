<div class="container container-cart">
    <h2>TU CARRITO DE LA COMPRA</h2>
    <div class="cart-wrapper">

        <?php if( $this->cart->total_items() === 0) { ?>
            <div class="cart-empty">
                <span>No hay productos en la cesta.</span>
            </div>
        <?php } else { ?>
            <?php foreach( $this->cart->contents() as $row): ?>
    
            <form action="<?= base_url('cart/cart/removeProduct'); ?>" method="post" class="cart-form">
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
                        <button type="submit" class="btn btn-original btn-cart-remove" name="rowid" value="<?= $row['rowid']; ?>">Eliminar</button>
                        
                    </div>
                    <div class="right-wrapper">
                        <span><?= number_format( $row['price'], 2, ',', '.'); ?>€</span>
                    </div>
                </div>
            </form>
    
            <?php endforeach; ?>
        <?php } ?>
        
        <div class="cart-buy">
            <div class="cart-total">
                <div class="cart-total-sum">
                    <span>Total (<?= $this->cart->total_items(); ?> productos): </span>                    
                    <span>
                        <strong><?= number_format($this->cart->total(), 2, ',', '.'); ?>€</strong>
                    </span>
                </div>
                <span>Todos los precios incluyen IVA.</span>
            </div>

            <?php if( $this->cart->total_items() != 0) { ?>

            <a href="<?= base_url('cart/cart/checkOut'); ?>" class="btn-buy-wrapper">
                <button class="btn btn-original btn-buy">Ir a caja</button>
            </a>
            
            <?php } ?>

        </div>
    </div>
</div>