<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2 class="mb-4">TUS DATOS PERSONALES</h2>

    <div class="row justify-content-md-center">
        <form name="form-change" action="<?= base_url('user/user_data/changeData') ?>" method="post">
            <div class="card">
                <div class="card-wrapper">
                    <div class="card-left">
                        <?php foreach( $user as $key => $value ): ?>
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change"><?= $key; ?>:</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-right"> 
                        
                        <?php foreach( $user as $key => $value): ?>
                            <?php if( !is_numeric($value) ) { ?>
                                <div class="card-body border-bottom border-light">
                                    <input type="text" name="<?= $key ?>" class="form-control form-control-sm input-form modal-close" value="<?= $value ?>" />
                                </div>
                            <?php } else { ?>
                                <div class="card-body border-bottom border-light">
                                    <input type="number" name="<?= $key ?>" class="form-control form-control-sm input-form modal-close" value="<?= $value ?>" />
                                </div>
                            <?php } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="btn-change-wrapper card-body">
                    <button type="submit" class="btn btn-original">Confirmar</button>
                    <button type="button" class="btn btn-original" onclick="location.href = '<?= base_url('user/user_data'); ?>';">Regresar</button>
                </div>
            </div>
        </form>
    </div>
    <?php if( isset( $error_change ) ) { ?>
        <span id="error-change" class="text-danger"><?php echo $error_change ?></span>
    <?php } ?>

</div>