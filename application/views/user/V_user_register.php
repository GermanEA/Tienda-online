<strong class="modal-close">¿Aún no tienes cuenta?</strong>
<form name="register-form" action="<?php echo base_url()?>single_page/registerUser" method="post" class="modal-close" onsubmit="return validateForm()">
    <div class="form-group modal-close">
        <input type="text" id="name-reg" name="name-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Nombre" />

        <input type="text" id="lastname-reg" name="lastname-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Apellido" /> 

        <input type="email" id="email-reg" name="email-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Correo electrónico" />

        <input type="password" id="pass-reg" name="pass-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Contraseña" />

        <input type="password" id="pass-reg-r" name="pass-reg-r" class="form-control form-control-sm input-form modal-close" value="" placeholder="Repite tu contraseña" />

        <input type="text" id="address-reg" name="address-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Dirección" />

        <input type="text" id="postal-reg" name="postal-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Código postal" />

        <input type="text" id="phone-reg" name="phone-reg" class="form-control form-control-sm input-form modal-close" value="" placeholder="Teléfono" />

        <input type="submit" id="btn-reg" value="REGISTRARSE" name="btn-reg" class="submit-button modal-close btn-original mb-1" disabled />

        <span id="alert-form" class="text-danger mb-1"></span>
        
        <?php if( isset( $error_reg ) ) { ?>
            <span id="error-loggin" class="text-danger modal-close"><?php echo $error_reg ?></span>
        <?php } ?>
    </div>
</form>