<?php if(!isset($orders) || $orders === NULL ) { ?>
    <div>No hay pedidos para mostrar.</div>
<?php } else { ?>

<form action="<?= base_url('administrator/dashboard/chooseBtn'); ?>" method="post">
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
            <?php foreach($order_header as $header): ?>
                <th><?= $header; ?></th>
            <?php endforeach; ?>
            <?php if( isset($confirm) ) { ?>
                <th><?= $confirm; ?></th>
            <?php } ?>
            <?php if( isset($modify) ) { ?>
                <th><?= $modify; ?></th>
            <?php } ?>
            <?php if( isset($cancel) ) { ?>
                <th><?= $cancel; ?></th>
            <?php } ?>
            <?php if( isset($details) ) { ?>
                <th><?= $details; ?></th>
            <?php } ?>
            </tr>
        </thead>                
        
        <tbody id="table-body">
            <?php foreach($orders as $row): ?>
            <tr>
            <?php foreach($row as $key => $value): ?>   
                <td class="align-middle">
                <?php if( substr_compare($key, 'Fecha', 0, 5, true) === 0 && $value != '0000-00-00' ) {
                        echo date("d-m-Y", strtotime($value));
                    } else if( $value === '0000-00-00') {
                        echo '';
                    } else { 
                        echo $value;
                    } ?>
                </td>
            <?php endforeach; ?>
            
            <?php if( isset($confirm) ) { ?>
                <td class="align-middle">
                    <button type="submit" class="btn btn-original" name="send-id" value="<?= $row['ID']; ?>"><?= $confirm; ?></button>
                </td>
            <?php } ?>
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
            <?php if( isset($details) ) { ?>
                <td class="align-middle">
                    <button id="<?= $row['ID']; ?>" type="button" class="btn btn-original btn-details" name="details-id" value="<?= $row['ID']; ?>"><?= $details; ?></button>
                </td>
            <?php } ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    
    </table>
</form>
<?php } ?>
<div class="btn-wrapper text-center">
    <button type="button" class="btn btn-original" onclick="window.location.href = '<?= base_url('/administrator/dashboard'); ?>';">Volver</button>
</div>
<?php if( isset($links) ) { ?>
    <?= $links; ?>
<?php } ?>