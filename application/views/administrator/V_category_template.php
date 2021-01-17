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

    <div class="content-table">
        <?php if(!isset($category) || $category === NULL ) { ?>
            <div>No hay categorías para mostrar.</div>
        <?php } else { ?>

        <form action="<?= base_url('administrator/category/chooseBtn'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($category_header as $header): ?>
                        <th><?= $header; ?></th>
                    <?php endforeach; ?>
                    <?php if( isset($modify) ) { ?>
                        <th><?= $modify; ?></th>
                    <?php } ?>
                    <?php if( isset($cancel) ) { ?>
                        <th><?= $cancel; ?></th>
                    <?php } ?>
                    </tr>
                </thead>                
                
                <tbody id="table-body">
                    <?php foreach($category as $row): ?>
                    <tr>
                    <?php foreach($row as $key => $value): ?>
                        <td class="align-middle"><?= $value; ?></td>
                    <?php endforeach; ?>
                    
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
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            
            </table>
        </form>
        <?php } ?>
    </div>
</div>