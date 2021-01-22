<div id="search" class="container container-product">
        <div class="card-deck">

        <?php if(isset($product)) {            
            $stock_check = false;
        foreach($product as $row): ?>
            <div class="card-wrapper col-4">
                <div class="card-item">
                    <img class="w-100" src="<?php echo base_url() . "/" . $row->imagen; ?>"   alt="<?php echo $row->descripcion; ?>">
                    <div class="card-title">
                        <span><?php echo $row->descripcion; ?></span>
                        <div class="price-corner text-center align-middle"><?= number_format($row->precio, 0); ?>€</div>
                        <hr class="hr-size">

                        <?php if( isset($size) ) { ?>
                        <span>Tallas disponibles:</span>
                        <ul class="size-group">

                        <?php foreach($size as $row_size): 
                            if($row->codigo_producto == $row_size->codigo_producto) { ?>

                                <li class="size-group-item"><?php echo $row_size->codigo_talla; ?></li>                     
                                
                        <?php } endforeach; ?>
                        </ul>
                        <?php } ?>

                    </div>

                    <?php foreach( $stock as $key => $value ):
                        if($row->codigo_producto == $key) {  
                            $stock_check = true;
                        } ?>
                    <?php endforeach; ?>

                    <?php if( $stock_check != true ) { ?>

                        <span type="button" class="btn btn-stock">FUERA DE STOCK</span>

                    <?php } else { ?>

                    <form method="post" action="<?= base_url('products/product_single'); ?>">
                        <input type="hidden" name="codigo" value="<?= $row->codigo_producto?>">
                        <input type="hidden" name="tipo" value="<?= $row->id_tipo_producto?>">
                        <button type="submit" class="btn btn-card">COMPRAR</button>
                    </form>

                    <?php } ?>






                </div>
            </div>
        <?php endforeach; } else { ?>
            <div>No hay productos en el almacén en estos momentos.</div>
        <?php } ?>
            
        </div>
    </div>
</div>