<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2 class="mb-4">TUS DATOS PERSONALES</h2>

    <div class="row justify-content-md-center">
        <div class="card">
            <div class="card-wrapper">
                <div class="card-left">
                    <div class="card-body border-bottom border-light">
                        <span>Nombre:</span>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <span>Apellidos:</span>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <span>Correo:</span>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <span>Dirección:</span>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <span>Código postal:</span>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <span>Teléfono:</span>
                    </div>
                </div>
                <div class="card-right">
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->nombre ?></div>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->apellido ?></div>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->email ?></div>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->direccion ?></div>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->codigo_postal ?></div>
                    </div>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?php echo $this->session->telefono ?></div>
                    </div>
                </div>
            </div>
            <div class="btn-data-wrapper card-body">
                <form name="form" action="<?php echo base_url()?>user/user_data/changeView" method="post">
                    <button type="submit" class="btn btn-original">Cambiar tus datos</button>
                </form>
            </div>
        </div>
    </div>

</div>