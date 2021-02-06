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

        <form enctype="multipart/form-data" action="<?= base_url('administrator/users/modifyUserConfirm'); ?>" method="post">
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
                        <td class="aling-middle"><?= $users['ID']; ?></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Nombre']; ?>" class="form-control form-text-user mx-auto" name="nombre" required></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Apellido']; ?>" class="form-control form-text-user mx-auto" name="apellido" required></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['DNI/NIE/CIF']; ?>" class="form-control form-text-user mx-auto" name="cif" required></td>

                        <td class="aling-middle"><?= $users['Password']; ?></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Dirección']; ?>" class="form-control form-text-user mx-auto" name="direccion" required></td>
                        
                        <td class="aling-middle"><input type="number" value="<?= $users['Código postal']; ?>" class="form-control form-number-user mx-auto" name="codigo-postal" min="0" required></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Localidad']; ?>" class="form-control form-text-user mx-auto" name="localidad" required></td>

                        <td class="aling-middle"><input type="number" value="<?= $users['Teléfono']; ?>" class="form-control form-number-user mx-auto" name="telefono" min="0" required></td>

                        <td class="aling-middle"><?= $users['Email']; ?></td>

                        <td class="aling-middle"><?= $users['Tipo usuario']; ?></td>
                                  
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" name="id" value="<?= $users['ID']; ?>" class="btn btn-original">Modificar</button>
            </div>
        </form>
    </div>
</div>

    