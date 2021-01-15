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

    <div class="container-order-details">
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
                <tr class="bg-total table-dark" scope="row">
                    <td class="bg-total" colspan="3"></td>
                    <td class="bg-total" colspan="2">TOTAL PEDIDO</td>
                    <td class="bg-total"><?= number_format($order_details[0]->total_venta, 2, ',', '.') . '€' ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>