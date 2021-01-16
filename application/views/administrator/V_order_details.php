<div class="content-info">
    <div class="content-header">
        <span><?= $title_page; ?></span>
    </div>

    <div class="container-order-details">
        <table class="table table-details table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Talla</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
    
                </tr>
            </thead>
            
            <tbody>
        <?php foreach($order_details as $key => $value): ?>
                <tr>
                    <td class="align-middle" scope="row">
                        <img class="img-fluid order-img" src="<?= base_url()  . "/" . $value->imagen; ?>" alt="<?= $value->imagen ?>">
                    </td>
                    <td class="align-middle"><?= $value->descripcion ?></td>
                    <td class="align-middle"><?= $value->codigo_talla ?></td>
                    <td class="align-middle"><?= $value->cantidad ?></td>
                    <td class="align-middle"><?= number_format($value->precio, 2, ',', '.') . '€' ?></td>
                    <td class="align-middle"><?= number_format($value->total, 2, ',', '.') . '€' ?></td>
                </tr>
        <?php endforeach; ?>
                <tr class="bg-total table-dark" scope="row">
                    <td class="bg-total align-middle" colspan="3"></td>
                    <td class="bg-total align-middle" colspan="2">TOTAL PEDIDO</td>
                    <td class="bg-total align-middle"><?= number_format($order_details[0]->total_venta, 2, ',', '.') . '€' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>