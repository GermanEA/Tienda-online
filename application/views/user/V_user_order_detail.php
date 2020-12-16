<div class="container container-order-details text-center">
    <h1 class="mt-2 mb-4">DETALLE DEL PEDIDO <?= $order_details[0]->codigo_venta ?></h1>
    <table class="table table-striped">
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
                <td scope="row">
                    <img class="img-fluid order-img" src="<?= base_url()  . "/" . $value->imagen; ?>" alt="<?= $value->imagen ?>">
                </td>
                <td><?= $value->descripcion ?></td>
                <td><?= $value->codigo_talla ?></td>
                <td><?= $value->cantidad ?></td>
                <td><?= number_format($value->precio, 2, ',', '.') . '€' ?></td>
                <td><?= number_format($value->total, 2, ',', '.') . '€' ?></td>
            </tr>
    <?php endforeach; ?>
            <tr class="bg-success table-dark" scope="row">
                <td class="bg-success" colspan="3"></td>
                <td class="bg-success" colspan="2">TOTAL PEDIDO</td>
                <td class="bg-success"><?= number_format($order_details[0]->total_venta, 2, ',', '.') . '€' ?></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-warning" onclick="javascript:window.history.go(-1);">Regresar</button>
</div>