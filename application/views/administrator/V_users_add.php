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

        <form enctype="multipart/form-data" action="<?= base_url('administrator/users/addUserConfirm'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($users as $key => $value): ?>
                        <th><?= $key; ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>                
                
                <tbody id="table-body">
                    <tr>
                        <td class="aling-middle"><?= $users['ID'] + 1; ?></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="nombre" required></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="apellido" required></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="cif" required></td>

                        <td class="aling-middle"><input type="password" class="form-control form-text-user mx-auto" name="pass" required></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="direccion" required></td>
                        
                        <td class="aling-middle"><input type="number" class="form-control form-number-user mx-auto" name="codigo-postal" min="1" required></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="localidad" required></td>

                        <td class="aling-middle"><input type="number" class="form-control form-number-user mx-auto" name="telefono" min="1" required></td>

                        <td class="aling-middle"><input type="email" class="form-control form-text-user mx-auto" name="email" required></td>

                        <td class="aling-middle">
                            <select class="form-control mx-auto" name="tipo" id="tipo">
                                <?php foreach( $type_users as $row ) : ?>
                                <option value="<?= $row['id_tipo_usuario']; ?>"><?= $row['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                                  
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" id="btn-add" name="id" value="<?= $users['ID'] + 1; ?>" class="btn btn-original">Añadir</button>
            </div>
        </form>
    </div>
</div>

<?php if( isset( $error_message ) ) { ?>
    <div id="error-message" class="text-danger">
        <div>
            <i class="fas fa-exclamation-triangle"></i>
            <span><?php echo $error_message ?></span>
        </div>
    </div>
<?php } ?>

    