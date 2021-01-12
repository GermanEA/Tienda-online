<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2 class="mb-4">LISTADO DE PEDIDOS</h2>

    <?php if(isset($list_orders)) { ?>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Orden</th>
                    <th scope="col">Código de pedido</th>
                    <th scope="col">Fecha pedido</th>
                    <th scope="col">Enviado</th>
                    <th scope="col">Acción</th>

                </tr>
            </thead>
            
            <tbody>
        <?php foreach($list_orders as $key => $value): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $value->codigo_venta ?></td>
                    <td><?= $value->fecha_pedido ?></td>
                    <td><?= $value->enviado ?></td>
                    <td>
                        <form name="form" action="<?php echo base_url()?>user/user_orders/orderDetails" method="post">
                            <button type="submit" class="btn btn-original" name="id_venta" value="<?= $value->id_venta ?>">Ver detalles</button>
                        </form>
                    </td>
                </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php } else { ?>
        
        <h2>No has realizado ningún pedido.</h2>

        <button type="button" class="btn btn-original" onclick="javascript:window.history.go(-1);">Regresar</button>

    <?php }; ?>
</div>

