<?php if( $this->session->logged == false || $this->session->id_tipo_usuario != 1 ) {
    redirect(base_url('/administrator/dashboard'), 'location', 301);
}
?>

<div class="title-content">
    <h2>
        <i class="fas fa-headphones"></i>
        <?= $title_page; ?>
        <span><?= $title_category; ?></span>    
    </h2>
</div>

<div class="content-info">
    <div class="content-header">
        <span><?= $title_page; ?></span>
    </div>

    <div class="content-table">

        <form enctype="multipart/form-data" action="<?= base_url('administrator/sizes/addSizeConfirm'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($sizes as $key => $value): ?>
                        <th><?= $key; ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>                
                
                <tbody id="table-body">
                    <tr>
                        <td class="aling-middle"><?= $sizes['ID'] + 1; ?></td>

                        <td class="aling-middle"><input type="text" class="form-control form-date mx-auto" id="codigo-talla" name="codigo-talla" required></td>
                        
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" id="btn-add" name="id" value="<?= $sizes['ID'] + 1; ?>" class="btn btn-original">Añadir</button>
            </div>
        </form>
    </div>
</div>