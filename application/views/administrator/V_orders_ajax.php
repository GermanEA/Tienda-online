
<?php if(!isset($orders) || $orders === NULL ) { ?>
    
<?php } else { 

    foreach($orders as $row): ?>
    <tr>
    <?php foreach($row as $key => $value): ?>   
        <td><?= $value; ?></td>
    <?php endforeach; ?>
    <?php if( isset($confirm) ) { ?>
        <td>
            <button type="submit" class="btn btn-original" name="send-id" value="<?= $row['ID']; ?>"><?= $confirm; ?></button>
        </td>
    <?php } ?>
    <?php if( isset($modify) ) { ?>
        <td>
            <button type="submit" class="btn btn-original" name="modify-id" value="<?= $row['ID']; ?>"><?= $modify; ?></button>
        </td>
    <?php } ?>
    <?php if( isset($cancel) ) { ?>
        <td>
            <button type="submit" class="btn btn-original" name="cancel-id" value="<?= $row['ID']; ?>"><?= $cancel; ?></button>
        </td>
    <?php } ?>
    <?php if( isset($details) ) { ?>
                        <td>
                            <button type="submit" class="btn btn-original" name="details-id" value="<?= $row['ID']; ?>"><?= $details; ?></button>
                        </td>
    <?php } ?>
    </tr>
    <?php endforeach;    

} ?>