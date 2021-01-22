<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2>LISTADO DE PEDIDOS</h2>

    <?php if(isset($list_orders)) { ?>

        <div class="order-wrapper">

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

            <div class="order-wrapper">            
                <div class="row justify-content-md-center">No has realizado ningún pedido.</div>
                <button type="button" class="btn btn-original" onclick="location.href = '<?= base_url('user/user_data'); ?>';">Regresar</button>
            </div>
        <?php }; ?>
        </div>
</div>

