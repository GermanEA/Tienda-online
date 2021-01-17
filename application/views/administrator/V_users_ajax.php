<?php if(!isset($users) || $users === NULL ) { ?>
    
<?php } else {foreach($users as $row): ?>
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
    <?php endforeach;

} ?>