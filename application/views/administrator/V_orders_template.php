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

    <?php if( isset($search) ) { ?>
        <div class="search-wrapper">
            <label for="search">Buscar:</label>
            <input id="search-bar" type="text" class="form-control form-search" name="search" placeholder="Inserta una factura">
        </div>
    <?php } ?>

    <?php if( isset($search_date) ) { ?>
        <div class="search-wrapper">
            <form action="<?= base_url('administrator/dashboard/searchAjaxDate'); ?>" method="post">
                <label for="search-date-start">Fecha inicio:</label>
                <input id="search-date-start" type="date" class="form-control form-search" name="search-date-start" required>
                <label for="search-date-end">Fecha final:</label>
                <input id="search-date-end" type="date" class="form-control form-search" name="search-date-end" required>
                <button type="submit" class="btn btn-original">Buscar</button>
            </form>
        </div>
    <?php } ?>

    <div id="content-body" class="content-table">
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
                        <td class="align-middle"><?= $value; ?></td>
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
        <?php if( isset($links) ) { ?>
            <?= $links; ?>
        <?php } ?>
    </div>
</div>

<div id="modal-details" class="modal-details">

    <div class="modal-details-content">
        <span id="modal-close" class="close">&times;</span>
        <div id="modal-content-dynamic"></div>
    </div>

</div>