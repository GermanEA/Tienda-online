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
            <input id="search-bar" type="text" class="form-control form-search" name="search">
        </div>
    <?php } ?>

    <?php if( isset($search_date) ) { ?>
        <div class="search-wrapper">
            <label for="search-date-start">Fecha inicio:</label>
            <input id="search-date-start" type="date" class="form-control form-search" name="search-date-start">
            <label for="search-date-end">Fecha final:</label>
            <input id="search-date-end" type="date" class="form-control form-search" name="search-date-end">
        </div>
    <?php } ?>

    <div class="content-table">
        <?php if(!isset($orders) || $orders === NULL ) { ?>
            <div>No hay pedidos para mostrar.</div>
        <?php } else { ?>

        <form action="<?= base_url('administrator/dashboard/chooseBtn'); ?>" method="post">
            <table class="table table-striped">
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
                        <td><?= $value; ?></td>
                    <?php endforeach; ?>
                    
                    <?php if( isset($confirm) ) { ?>
                        <td>
                            <button type="submit" class="btn btn-original" name="send-id" value="<?= $row['ID']; ?>"><?= $confirm; ?></button>
                        </td>
                    <?php } ?>
                    <?php if( isset($modify) ) { ?>
                        <td>
                            <button type="submit" class="btn btn-original" name="modify-id" value="<?= $row['ID']; ?>"><?= $modify; ?></button>
                        </td>
                    <?php } ?>
                    <?php if( isset($cancel) ) { ?>
                        <td>
                            <button type="submit" class="btn btn-original" name="cancel-id" value="<?= $row['ID']; ?>"><?= $cancel; ?></button>
                        </td>
                    <?php } ?>
                    <?php if( isset($details) ) { ?>
                        <td>
                            <button type="submit" class="btn btn-original" name="details-id" value="<?= $row['ID']; ?>"><?= $details; ?></button>
                        </td>
                    <?php } ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            
            </table>
        </form>
        <?php } ?>

    </div>
</div>