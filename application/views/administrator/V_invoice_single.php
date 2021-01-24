<div class="title-content">
    <h2>
        <i class="fas fa-headphones"></i>
        <?= $title_page; ?>
        <span><?= $title_category; ?></span>    
    </h2>
</div>

<div class="content-info">
    <div class="content-header">
        <span><?= $invoice[0]->codigo_factura; ?></span>
    </div>

    <div id="content-body" class="content-table content-invoice-wrapper">
        <div class="invoice-wrapper">
            <div class="header-invoice">
                <div class="logo">
                    <img src="<?= base_url('public/assets/img/logo-transp.png'); ?>" alt="logo enseco">
                </div>   
                <div class="data-enseco">
                    <span>Calle del abrevadero S/N</span>
                    <span>11401 - Jerez de la Frontera (Cádiz)</span>
                    <span>Teléfono de contacto: 956 156 145</span>
                </div>             
            </div>

            <div class="data-wrapper">
                <div class="data-costumer">
                    <div class="data-header">Facturar a</div>
                    <span class="costumer-name"><?= $invoice[0]->nombre . ' ' . $invoice[0]->apellido; ?></span>
                    <span><?= $invoice[0]->cif; ?></span>
                    <span><?= $invoice[0]->direccion; ?></span>
                    <span><?= $invoice[0]->codigo_postal . ' ' . $invoice[0]->localidad; ?></span>
                    
                    <?php if( $invoice[0]->telefono != 0) { ?>
                        <span><?= $invoice[0]->telefono; ?></span>
                    <?php } ?>
                    
                    <span><?= $invoice[0]->email; ?></span>
                </div>
                <div class="data-invoice">
                    <span class="data-header">FACTURA</span>
                    <span>Factura: <?= $invoice[0]->codigo_factura; ?></span>
                    <span>Fecha de factura: <?= date("d-m-Y", strtotime($invoice[0]->fecha_pedido)); ?></span>
                    <span>Fecha de vencimiento: <?= date("d-m-Y", strtotime($invoice[0]->fecha_pedido . "+ 30 days")); ?></span>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio por unidad</th>
                        <th>Importe</th>
                    </tr>
                </thead>

                <tbody id="table-body">

                <?php foreach( $invoice as $row ): ;?>
                    <tr>                        
                        <td class="text-center"><?= $row->cantidad; ?></td>
                        <td><?= $row->descripcion; ?></td>
                        <td class="text-center"><?= number_format($row->precio / 1.21, 2, ',', '.') . '€'; ?></td>
                        <td class="text-center"><?= number_format($row->total / 1.21, 2, ',', '.') . '€'; ?></td>
                    </tr>
                <?php endforeach; ?>

                    <tr>
                        <td class="text-center">1</td>
                        <td>Gastos de envío</td>
                        <td class="text-center"></td>
                        <td class="text-center">
                        <?php if( $row->total_pedido < 50 ) {
                            echo number_format(10 / 1.21, 2, ',', '.') . '€'; 
                        } else { ?>
                            Gratuitos
                        <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="text-right">Subtotal</td>
                        <td class="text-center"><?= number_format($row->total_pedido / 1.21, 2, ',', '.') . '€'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">IVA(21%)</td>
                        <td class="text-center"><?= number_format($row->total_pedido / 1.21 * 0.21, 2, ',', '.') . '€'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">TOTAL</td>
                        <td class="text-center"><?= number_format($row->total_pedido, 2, ',', '.') . '€'; ?></td>
                    </tr>
                </tbody>

            </table>

            <div class="data-other">
                <span class="other-title">Forma de pago</span>
                <span class="other-data">Pagado con tarjeta bancaria</span>
            </div>
        </div>

        <div class="btn-wrapper text-center">
            <button type="button" class="btn btn-original" onclick="window.location.href = '<?= base_url('/administrator/invoice/showAllInvoice'); ?>';">Volver</button>
        </div>
    </div>

</div>