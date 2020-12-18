
    <div class="modal-wrapper modal-close">
        <div class="modal-content-wrapper modal-close">
        <?php if(isset($search)) {
            foreach($search as $row): ?>
                <a class="modal-link modal-close" href="">
                    <img class="modal-close" src="<?= base_url($row->imagen); ?>" alt="<?= base_url($row->descripcion); ?>">
                    <span class="modal-close"><?= $row->descripcion; ?></span>
                </a>
            <?php endforeach; } else { ?>
                <span class="modal-close">No existen sugerencias.</span>
            <?php } ?>
        </div>
    </div>
