
<div class="container col-2 d-flex flex-column my-5 sidebar-left">

    <span class="text-center filter-text mb-3">Filtros</span>

    <?php foreach($product_list as $row): ?>
        <label class="form-check b-contain">
            <span class="form-check-label" for="<?php echo $row->tipo_producto ?>">
                <?php echo $row->tipo_producto ?>
            </span>
            <input class="form-check-input" type="checkbox" value="" id="<?php echo $row->tipo_producto ?>">
            <div class="b-input"></div>
    </label>
    <?php endforeach; ?>

</div>
    
