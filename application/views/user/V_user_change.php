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
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change">Nombre:</span>
                        </div>
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change">Apellidos:</span>
                        </div>
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change">Dirección:</span>
                        </div>
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change">Código postal:</span>
                        </div>
                        <div class="card-body border-bottom border-light">
                            <span class="label-form-change">Teléfono:</span>
                        </div>
                    </div>
                    <div class="card-right">                
                        <div class="card-body border-bottom border-light">
                            <input type="text" name="name-change" class="form-control form-control-sm input-form modal-close" value="<?php echo $this->session->nombre ?>" />
                        </div>
                        <div class="card-body border-bottom border-light">
                            <input type="text" name="lname-change" class="form-control form-control-sm input-form modal-close" value="<?php echo $this->session->apellido ?>" />
                        </div>
                        <div class="card-body border-bottom border-light">
                            <input type="text" name="address-change" class="form-control form-control-sm input-form modal-close" value="<?php echo $this->session->direccion ?>" />
                        </div>
                        <div class="card-body border-bottom border-light">
                            <input type="number" name="postal-change" class="form-control form-control-sm input-form modal-close" value="<?php echo $this->session->codigo_postal ?>" />
                        </div>
                        <div class="card-body border-bottom border-light">
                            <input type="number" name="phone-change" class="form-control form-control-sm input-form modal-close" value="<?php echo $this->session->telefono ?>" />
                        </div>
                    </div>
                </div>
                <div class="btn-change-wrapper card-body">
                    <button type="submit" class="btn btn-original">Confirmar</button>
                    <button type="button" class="btn btn-original" onclick="javascript:window.history.go(-1);">Regresar</button>
                </div>
            </div>
        </form>
    </div>
    <?php if( isset( $error_change ) ) { ?>
        <span id="error-change" class="text-danger"><?php echo $error_change ?></span>
    <?php } ?>

</div>