<div id="search" class="container container-product">
        <div class="card-deck">

        <?php foreach($discs as $row): ?>
            <div class="card-wrapper col-4">
                <div class="card-item">
                    <div class="price-corner text-center align-middle"><?php echo $row->precio; ?>€</div>
                    <img class="w-100" src="<?php echo base_url() . "/" . $row->imagen; ?>"   alt="<?php echo $row->descripcion; ?>">
                    <div class="card-title">
                        <span><?php echo $row->descripcion; ?></span>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-card">COMPRAR</button>
                </div>
            </div>
        <?php endforeach; ?>
            
        </div>
    </div>
</div>