<?php if(!isset($users) || $users === NULL ) { ?>
    <div>No hay pedidos para mostrar.</div>
<?php } else { ?>

<form action="<?= base_url('administrator/users/chooseBtn'); ?>" method="post">
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
            <?php foreach($users_header as $header): ?>
                <th><?= $header; ?></th>
            <?php endforeach; ?>
            <?php if( isset($modify) ) { ?>
                <th><?= $modify; ?></th>
            <?php } ?>
            <?php if( isset($cancel) ) { ?>
                <th><?= $cancel; ?></th>
            <?php } ?>
            </tr>
        </thead>                
        
        <tbody id="table-body">
            <?php foreach($users as $row): ?>
            <tr>
            <?php foreach($row as $key => $value): ?>
                <?php if( $key == "Imagen" ) { ?>
                    <td class="align-middle">
                        <img src="<?= base_url($value); ?>">
                    </td>
                <?php } else { ?>
                    <td class="align-middle"><?= $value; ?></td>
                <?php } ?>
            <?php endforeach; ?>
            
            <?php if( isset($modify) ) { ?>
                <td class="align-middle">
                    <button type="submit" class="btn btn-original" name="modify-id" value="<?= $row['ID']; ?>"><?= $modify; ?></button>
                </td>
            <?php } ?>
            <?php if( isset($cancel) ) { ?>
                <td class="align-middle">
                    <button type="submit" class="btn btn-original" name="cancel-id" value="<?= $row['ID']; ?>"><?= $cancel; ?></button>
                </td>
            <?php } ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    
    </table>
</form>
<?php } ?>
<div class="btn-wrapper text-center">
    <button type="button" class="btn btn-original" onclick="window.location.href = '<?= base_url('/administrator/users/showAllUsers'); ?>';">Volver</button>
</div>
<?php if( isset($links) ) { ?>
    <?= $links; ?>
<?php } ?>