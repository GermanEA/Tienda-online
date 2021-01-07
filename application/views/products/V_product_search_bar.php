
    <div class="modal-wrapper modal-close">
        <div class="modal-content-wrapper modal-close">
        <?php if(isset($search)) {
            foreach($search as $row): ?>
                <form class="form-search" method="post" action="<?= base_url('products/product_single'); ?>">
                    <div class="modal-link modal-close">
                        <input type="hidden" name="codigo" value="<?= $row->codigo_producto?>">
                        <input type="hidden" name="tipo" value="<?= $row->id_tipo_producto?>">
                        <button type="submit" class="btn btn-card">
                            <img class="modal-close" src="<?= base_url($row->imagen); ?>" alt="<?= base_url($row->descripcion); ?>">
                            <span class="modal-close"><?= $row->descripcion; ?></span>
                        </button>
                    </div>
                </form>
            <?php endforeach; } else { ?>
                <span class="modal-close">No existen sugerencias.</span>
            <?php } ?>
        </div>
    </div>
