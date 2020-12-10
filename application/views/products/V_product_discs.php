<h1>DISCOS</h1>
<div class="card-deck">

<?php foreach($discs as $row): ?>
    <div class="col-sm-2"">
        <div class="card">
            <img class="card-img-top" src="<?php echo base_url() . "/" . $row->imagen; ?>"   alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row->descripcion; ?></h5>
            </div>
            <div class="card-footer">
                <small class="text-muted">PRECIO: <?php echo $row->precio; ?>€</small>
                <button type="button" class="btn btn-warning">AÑADIR AL CARRITO</button>
            </div>
        </div>
    </div>
<?php endforeach; ?>
    
</div>