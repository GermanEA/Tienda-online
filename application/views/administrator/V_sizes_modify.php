<?php if( $this->session->logged == false || $this->session->id_tipo_usuario > 2 ) {
    redirect(base_url(), 'location', 301);
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

        <form enctype="multipart/form-data" action="<?= base_url('administrator/sizes/modifySizesConfirm'); ?>" method="post">
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
                        <td class="aling-middle"><?= $sizes['ID']; ?></td>
                        <td class="aling-middle"><input type="text" value="<?= $sizes['Código talla']; ?>" class="form-control form-date mx-auto" name="codigo-talla"></td>
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" name="id" value="<?= $sizes['ID']; ?>" class="btn btn-original">Modificar</button>
            </div>
        </form>
    </div>
</div>
