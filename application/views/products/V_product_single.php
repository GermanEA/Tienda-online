    <div class="container container-product-single">

        <div class="image-wrapper">
            <img class="img-fluid" src="<?= base_url() . "/" . $product[0]->imagen; ?>"   alt="<?= $product[0]->descripcion; ?>">
        </div>

        <div class="details-wrapper">
            <div class="tittle">
                <h2>Enseco</h2>
                <h1><?= mb_strtoupper($product[0]->descripcion); ?></h1>
                <span>CÓDIGO PRODUCTO: <?= $product[0]->codigo_producto; ?></span>
            </div>
            <div class="price">
                <span><?= number_format( $product[0]->precio, 2, ',', '.'); ?>€</span>
            </div>
            <form action="" method="post">
                <?php if( isset($size) ) { ?>

                    <div class="size">
                        <span>Talla:</span>
                        <span>Requerido</span>
                        <div class="radio-button-wrapper">    
                            
                            <?php foreach($size as $row_size): 
                                if($product[0]->codigo_producto == $row_size->codigo_producto) { ?>
                                    
                                    <label class="b-contain">
                                        <span><?php echo $row_size->codigo_talla; ?></span>
                                        <input type="radio" id="<?php echo $row_size->codigo_talla; ?>" name="<?= $row_size->codigo_producto ?>" value="<?php echo $row_size->codigo_talla; ?>">
                                        <div class="b-input"></div>
                                    </label>
    
                            <?php } endforeach; ?>
    
                        </div>
                    </div>

                <?php } ?>

                <div class="quantity">
                    <label for="quantity">Cantidad:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" pattern=[0-9]*>
                </div>
                <button type="button" class="btn btn-original" data-toggle="tooltip" data-placement="bottom" title="Selecciona una talla">Añadir al carrito</button>
            </form>
            <div class="description">
                <h3>DESCRIPCIÓN DEL PRODUCTO</h3>

                <?php if( isset($product[0]->material) ) { ?>
                    <span>Material: <?= $product[0]->material; ?> </span>
                <?php } ?>
            </div>
        </div>
        

        
    </div>
</div>