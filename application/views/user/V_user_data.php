<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2 class="mb-4">TUS DATOS PERSONALES</h2>

    <div class="row justify-content-md-center">
        <div class="card">
            <div class="card-body border-bottom border-light">
                <div class="card-text">Nombre: <?php echo $this->session->nombre ?></div>
            </div>
            <div class="card-body border-bottom border-light">
                <div class="card-text">Apellidos: <?php echo $this->session->apellido ?></div>
            </div>
            <div class="card-body border-bottom border-light">
                <div class="card-text">Correo: <?php echo $this->session->email ?></div>
            </div>
            <div class="card-body border-bottom border-light">
                <div class="card-text">Dirección: <?php echo $this->session->direccion ?></div>
            </div>
            <div class="card-body border-bottom border-light">
                <div class="card-text">Código postal: <?php echo $this->session->codigo_postal ?></div>
            </div>
            <div class="card-body border-bottom border-light">
                <div class="card-text">Teléfono: <?php echo $this->session->telefono ?></div>
            </div>
            <div class="card-body">
                <form name="form" action="<?php echo base_url()?>user/user_data/changeData" method="post">
                        <button type="submit" class="btn btn-warning">Cambiar tus datos</button>
                </form>
            </div>
        </div>
    </div>

</div>