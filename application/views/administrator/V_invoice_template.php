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
            <input id="search-bar" type="text" class="form-control form-search" name="search" placeholder="Inserta un código">
        </div>
    <?php } ?>

    <div id="content-body" class="content-table">
        <?php if(!isset($invoice) || $invoice === NULL ) { ?>
            <div>No hay elementos para mostrar.</div>
        <?php } else { ?>

        <form action="<?= base_url('administrator/invoice/chooseBtn'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($invoice_header as $header): ?>
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
                    <?php foreach($invoice as $row): ?>
                    <tr>
                    <?php foreach($row as $key => $value): ?>
                        <?php if( $key == "Imagen" ) { ?>
                            <td class="align-middle">
                                <img src="<?= base_url($value); ?>">
                            </td>
                        <?php } else { ?>
                            <td class="align-middle"><?= $value; ?></td>
                        <?php } ?>
                    <?php endforeach; ?>
                    
                    <?php if( isset($confirm) ) { ?>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-original btn-confirm" name="confirm-id" value="<?= $row['ID']; ?>"><?= $confirm; ?></button>
                        </td>
                    <?php } ?>
                    <?php if( isset($modify) ) { ?>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-original btn-modify" name="modify-id" value="<?= $row['ID']; ?>"><?= $modify; ?></button>
                        </td>
                    <?php } ?>
                    <?php if( isset($cancel) ) { ?>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-original btn-cancel" name="cancel-id" value="<?= $row['ID']; ?>"><?= $cancel; ?></button>
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