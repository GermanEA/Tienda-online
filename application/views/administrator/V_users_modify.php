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

                        <td class="aling-middle"><input type="text" value="<?= $users['Nombre']; ?>" class="form-control form-text-user mx-auto" name="nombre"></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Apellido']; ?>" class="form-control form-text-user mx-auto" name="apellido"></td>

                        <td class="aling-middle"><input type="text" value="<?= $users['Dirección']; ?>" class="form-control form-text-user mx-auto" name="direccion"></td>
                        
                        <td class="aling-middle"><input type="number" value="<?= $users['Código postal']; ?>" class="form-control form-number-user mx-auto" name="codigo-postal" min="1"></td>

                        <td class="aling-middle"><input type="number" value="<?= $users['Teléfono']; ?>" class="form-control form-number-user mx-auto" name="telefono" min="1"></td>

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

    