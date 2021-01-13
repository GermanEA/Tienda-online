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
            <span>Buscar:</span>
            <input id="search-bar" type="text" class="form-control" name="search">
        </div>
    <?php } ?>

    <div class="content-table">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <?php foreach($order_header as $header): ?>
                            <th><?= $header; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach($orders as $row): ?>
                <tr>
                    <?php foreach($row as $key => $value): ?>   
                    <td><?= $value; ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>