<div class="container container-product-single">
    <div class="image-wrapper">
        <img class="img-fluid" src="<?= base_url() . "/" . $product[0]->imagen; ?>" alt="<?= $product[0]->descripcion; ?>">
    </div>

    <div class="details-wrapper">
        <div class="title">
            <h2>Enseco</h2>
            <h1 id="product-name"><?= mb_strtoupper($product[0]->descripcion); ?></h1>
            <span id="product-code">CÓDIGO PRODUCTO: <?= $product[0]->codigo_producto; ?></span>
        </div>
        <div class="price">
            <span id="product-price"><?= number_format( $product[0]->precio, 2, ',', '.'); ?>€</span>
        </div>
            
                <?php if( isset($size) ) { ?>    

                <div class="size">
                    <span>Tallas:</span>
                    <span>Requerido</span>
                    <div class="radio-button-wrapper">
                        
                        <?php foreach($size as $row_size): 
                            if($product[0]->codigo_producto == $row_size->codigo_producto) { ?>
                                
                                <label class="b-contain">
                                    <span><?php echo $row_size->codigo_talla; ?></span>
                                    <input type="radio" id="<?php echo $row_size->codigo_talla; ?>" name="size" value="<?php echo $row_size->codigo_talla; ?>">
                                    <div class="b-input"></div>
                                </label>

                        <?php } endforeach; ?>

                        <div id="size-message" class="size-message">Debes elegir una talla</div>
                    </div>
                </div>

                <?php } ?>

            <div class="cart-wrapper">
                <div class="quantity-wrapper">
                    <label for="quantity">Cantidad:</label>
                    <div class="quantity-number">
                        <div id="minus">-</div>
                        <input type="number" id="quantity" name="qty" value="1" min="1" pattern=[0-9]*>
                        <div id="plus">+</div>
                        <button id="btn-cart-single" type="button" class="btn btn-original" >Añadir al carrito</button>
                    </div>
                </div>
            </div>
        <div class="description">
            <h3>DESCRIPCIÓN DEL PRODUCTO</h3>

            <?php if( isset($product[0]->material) ) { ?>
                <span>Material: <?= $product[0]->material; ?> </span>
            <?php } ?>
        </div>
    </div>

    <div id="notifications" class="notifications-wrapper">
        <span>Se ha añadido <?= mb_strtoupper($product[0]->descripcion); ?> al carrito.</span>
    </div>

</div>