<div id="search" class="container container-product">
        <div class="card-deck">

        <?php foreach($sweatshirt as $row): ?>
            <div class="card-wrapper col-4">
                <div class="card-item">
                    <div class="price-corner text-center align-middle"><?php echo $row->precio; ?>€</div>
                    <img class="w-100" src="<?php echo base_url() . "/" . $row->imagen; ?>"   alt="<?php echo $row->descripcion; ?>">
                    <div class="card-title">
                        <span><?php echo $row->descripcion; ?></span>
                        <hr class="hr-size">

                        <div class="radio-button-wrapper">

                            <?php foreach($size as $row_size): 
                                if($row->codigo_producto == $row_size->codigo_producto) { ?>
                                    
                                    <label class="b-contain">
                                        <span><?php echo $row_size->codigo_talla; ?></span>
                                        <input type="radio" id="<?php echo $row_size->codigo_talla; ?>" name="<?= $row_size->codigo_producto ?>" value="<?php echo $row_size->codigo_talla; ?>">
                                        <div class="b-input"></div>
                                    </label>
    
                            <?php } endforeach; ?>

                        </div>

                    </div>
                    <button type="button" class="btn btn-card">COMPRAR</button>
                </div>
            </div>
        <?php endforeach; ?>
            
        </div>
    </div>
</div>