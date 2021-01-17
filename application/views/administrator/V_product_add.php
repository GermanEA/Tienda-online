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

        <form enctype="multipart/form-data" action="<?= base_url('administrator/product/addProductConfirm'); ?>" method="post">
            <table class="table table-striped text-center">
                <thead class="table-dark">
                    <tr>
                    <?php foreach($product as $key => $value): ?>
                        <th><?= $key; ?></th>
                    <?php endforeach; ?>
                    </tr>
                </thead>                
                
                <tbody id="table-body">
                    <tr>
                        <td class="aling-middle"><?= $product['ID'] + 1; ?></td>

                        <td class="aling-middle"><input type="text" class="form-control form-date mx-auto" id="codigo-producto" name="codigo-producto"></td>

                        <td class="aling-middle"><input type="text" class="form-control form-date mx-auto" id="descripcion" name="descripcion"></td>  
                        
                        
                        <td class="aling-middle"><input type="text" class="form-control form-date mx-auto" id="material" name="material"></td>
                        
                        <td class="aling-middle">
                            <select class="form-control mx-auto" name="talla" id="talla">
                                <option value="NULL">No</option>
                                <?php foreach($sizes as $size):
                                    foreach($size as $key => $value): ?>
                                        <option value="<?= $value; ?>"><?= $value; ?></option>
                                    <?php endforeach; 
                                endforeach; ?>
                            </select>
                        </td>
                        
                        <td class="aling-middle"><input type="number" class="form-control form-number mx-auto" value="1" name="precio" min="1"></td>

                        <td class="aling-middle"><input type="text" class="form-control form-date mx-auto" id="color" name="color"></td>

                        <td class="aling-middle"><input type="number" class="form-control form-number mx-auto" value="1" name="stock" min="0"></td>

                        <td class="aling-middle"><input type="file" class="form-control form-file" id="formFile" name="imagen"></td>
                        
                        <td class="aling-middle">
                            <select class="form-control mx-auto" name="tipo-producto" id="tipo-producto">                                
                                <?php foreach($product_type as $row):
                                    foreach($row as $key => $value): ?>
                                        <option value="<?= $value; ?>"><?= $value; ?></option>
                                    <?php endforeach; 
                                endforeach; ?>
                            </select>
                        </td>  

                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" id="btn-add" name="id" value="<?= $product['ID'] + 1; ?>" class="btn btn-original" disabled>Añadir</button>
            </div>
        </form>
    </div>
</div>

<div id="modal-details" class="modal-details">

    <div class="modal-details-content">
        <span id="modal-close" class="close">&times;</span>
        <div id="modal-content-dynamic"></div>
    </div>

</div>