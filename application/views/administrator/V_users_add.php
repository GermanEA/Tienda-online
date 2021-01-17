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

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="nombre"></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="apellido"></td>

                        <td class="aling-middle"><input type="password" class="form-control form-text-user mx-auto" name="pass"></td>

                        <td class="aling-middle"><input type="text" class="form-control form-text-user mx-auto" name="direccion"></td>
                        
                        <td class="aling-middle"><input type="number" class="form-control form-number-user mx-auto" name="codigo-postal" min="1"></td>

                        <td class="aling-middle"><input type="number" class="form-control form-number-user mx-auto" name="telefono" min="1"></td>

                        <td class="aling-middle"><input type="email" class="form-control form-text-user mx-auto" name="email"></td>

                        <td class="aling-middle">
                            <select class="form-control mx-auto" name="tipo" id="tipo">
                                <option value="0">Administrador</option>                                
                                <option value="1">Cliente</option>
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

    