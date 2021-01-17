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

        <form enctype="multipart/form-data" action="<?= base_url('administrator/product/modifyProductConfirm'); ?>" method="post">
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
                        <td class="aling-middle"><?= $product['ID']; ?></td>
                        <td class="aling-middle"><?= $product['Código producto']; ?></td>
                        <td class="aling-middle"><input type="text" value="<?= $product['Descripción']; ?>" class="form-control form-date mx-auto" name="descripcion"></td>

                        <?php if( $product['Material'] != NULL ) { ?>
                            <td class="aling-middle"><input type="text" value="<?= $product['Material']; ?>" class="form-control form-date mx-auto" name="material"></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>

                        <?php if( $product['Talla'] != NULL ) { ?>
                            <td class="aling-middle">
                                <select class="form-control mx-auto" name="talla" id="talla">
                                    <?php foreach($sizes as $size):
                                        foreach($size as $key => $value): 
                                            if( $value == $product['Talla'] ){ ?>
                                                <option value="<?= $value; ?>" selected><?= $value; ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $value; ?>"><?= $value; ?></option>
                                            <?php } 
                                        endforeach; 
                                    endforeach; ?>
                                </select>
                            </td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        
                        <td class="aling-middle"><input type="number" value="<?= $product['Precio']; ?>" class="form-control form-number mx-auto" name="precio" min="1"></td>

                        <?php if( $product['Color'] != NULL ) { ?>
                            <td class="aling-middle"><input type="text" value="<?= $product['Color']; ?>" class="form-control form-date mx-auto" name="color"></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        
                        <td class="aling-middle"><input type="number" value="<?= $product['Stock']; ?>" class="form-control form-number mx-auto" name="stock" min="0"></td>
                        <td class="aling-middle"><input type="file" class="form-control form-file" id="formFile" name="imagen"></td>
                        <td class="aling-middle">
                            <select class="form-control mx-auto" name="tipo-producto" id="tipo-producto">
                                <?php foreach($product_type as $row):
                                    foreach($row as $key => $value): 
                                        if( $value == $product['Tipo producto'] ){ ?>
                                            <option value="<?= $value; ?>" selected><?= $value; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $value; ?>"><?= $value; ?></option>
                                        <?php } 
                                    endforeach; 
                                endforeach; ?>
                            </select>
                        </td>          
                    </tr>
                </tbody>            
            </table>
                        
            <div class="btn-wrapper text-center">
                <button type="submit" name="id" value="<?= $product['ID']; ?>" class="btn btn-original">Modificar</button>
            </div>
        </form>
    </div>
</div>

    