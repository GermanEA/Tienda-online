<div class="container container-cart-response">
    <h2>Compra finalizada</h2>
    <div class="content-cart-wrapper">
        <div class="principal-message"><?= $message; ?></div>

        <?php if( $success ) { ?>
            <div class="secondary-message">
                <span>Gracias por ayudar a Enseco.</span>
            </div>
            <div class="secondary-message">
                <span>Sin ti no sería posible. </span>
            </div>
            <div class="btn-wrapper">
                <a href="<?= base_url(); ?>">
                    <button type="button" class="btn btn-original">Volver</button>
                </a>
            </div>
        <?php } else { ?>
            <div class="secondary-message">Vuelve a intentarlo pasados unos minutos.</div>
            <div class="btn-wrapper">
                <a href="<?= base_url('/cart/cart/checkout'); ?>">
                    <button type="button" class="btn btn-original">Volver a intentarlo</button>
                </a>
            </div>
        <?php } ?>
    </div>
</div>