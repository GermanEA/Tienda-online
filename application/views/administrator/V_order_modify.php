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

        <form action="<?= base_url('administrator/dashboard/modifyOrderConfirm'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($order as $key => $value): ?>
                        <th><?= $key; ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>                
                
                <tbody id="table-body">
                    <tr>
                        <td class="aling-middle"><?= $order['ID']; ?></td>
                        <td class="aling-middle"><?= $order['Código']; ?></td>
                        <td class="aling-middle"><input type="date" value="<?= $order['Fecha pedido']; ?>" class="form-control form-date mx-auto" name="fecha-pedido"></td>
                        <td class="aling-middle"><input type="date" value="<?= $order['Fecha confirmación']; ?>" class="form-control form-date mx-auto" name="fecha-confirmacion"></td>
                        <td class="aling-middle"><input type="date" value="<?= $order['Fecha entrega']; ?>" class="form-control form-date mx-auto" name="fecha-entrega"></td>
                        <td class="aling-middle">                           
                            <select class="form-control form-select mx-auto" name="enviado" id="send">
                                <option value="Si" <?php if( $order['Enviado'] === 'Si') { echo "selected"; } ?>>Si</option>
                                <option value="No" <?php if( $order['Enviado'] === 'No') { echo "selected"; } ?>>No</option>
                            </select>                            
                        </td>
                        <td class="aling-middle"><input type="number" value="<?= $order['Total pedido']; ?>" class="form-control form-number mx-auto" name="total-pedido" min="0"></td>
                        <td class="aling-middle"><?= $order['Correo usuario']; ?></td>                   
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" name="id" value="<?= $order['ID']; ?>" class="btn btn-original">Modificar</button>
            </div>
        </form>
    </div>
</div>