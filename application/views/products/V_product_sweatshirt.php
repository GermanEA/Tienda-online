<div id="search" class="container container-product">
        <div class="card-deck">

        <?php foreach($sweatshirt as $row): ?>
            <div class="card-wrapper col-4">
                <div class="card-item">
                    <img class="w-100" src="<?php echo base_url() . "/" . $row->imagen; ?>"   alt="<?php echo $row->descripcion; ?>">
                    <div class="card-title">
                        <span><?php echo $row->descripcion; ?></span>
                        <div class="price-corner text-center align-middle"><?= number_format($row->precio, 0); ?>€</div>
                        <hr class="hr-size">

                        <span>Tallas disponibles:</span>
                        <ul class="size-group">
                        <?php foreach($size as $row_size): 
                            if($row->codigo_producto == $row_size->codigo_producto) { ?>

                                <li class="size-group-item"><?php echo $row_size->codigo_talla; ?></li> 

                        <?php } endforeach; ?>
                        </ul>

                    </div>
                    <form method="post" action="<?= base_url('products/product_single'); ?>">
                        <input type="hidden" name="codigo" value="<?= $row->codigo_producto?>">
                        <input type="hidden" name="tipo" value="<?= $row->id_tipo_producto?>">
                        <button type="submit" class="btn btn-card">COMPRAR</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
            
        </div>
    </div>
</div>