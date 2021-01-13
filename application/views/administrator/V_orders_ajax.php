
<?php if(!isset($orders) || $orders === NULL ) { ?>
    
<?php } else { 

    foreach($orders as $row): ?>
    <tr>
        <?php foreach($row as $key => $value): ?>   
        <td><?= $value; ?></td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach;

} ?>