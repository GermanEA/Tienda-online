<?php if( $this->session->logged == false) {
    redirect(base_url(), 'location', 301);
} ?>

<div class="container container-orders text-center">
    <h2 class="mb-4">TUS DATOS PERSONALES</h2>

    <div class="row justify-content-md-center">
        <div class="card">
            <div class="card-wrapper">
                <div class="card-left">
                    <?php foreach( $user as $key => $value ): ?>
                    <div class="card-body border-bottom border-light">
                        <span><?= $key; ?>:</span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="card-right">
                    <?php foreach( $user as $key ): ?>
                    <div class="card-body border-bottom border-light">
                        <div class="card-text"><?= $key ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="btn-data-wrapper card-body">
                <form name="form" action="<?= base_url()?>user/user_data/changeView" method="post">
                    <button type="submit" class="btn btn-original">Cambiar tus datos</button>
                </form>
            </div>
        </div>
    </div>

</div>