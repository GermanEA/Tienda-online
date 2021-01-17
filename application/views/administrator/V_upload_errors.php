<div class="title-content">
    <h2>
        <i class="fas fa-headphones"></i>
        <?= $title_page; ?>
        <span><?= $title_category; ?></span>    
    </h2>
</div>

<div class="content-info">
    <div class="content-header">
        <span>Error en la subida de la imagen</span>
    </div>

    <div class="content-table content-file-wrapper">

        <div class="error-title"><?= $error; ?></div>
        <div class="file-title">Características para subir una imagen:</div>
        <div class="file-properties">
            <div>Tipos de fichero permitidos: gif | jpg | png</div>
            <div>Tamaño máximo: 1MB</div>
            <div>Ancho máximo (pixels): 3000</div>
            <div>Alto máximo (pixels): 3000</div>
        </div>
        <a href="javascript:window.history.go(-2);">
            <button type="button" class="btn btn-original">Volver</button>
        </a>

    </div>
</div>
