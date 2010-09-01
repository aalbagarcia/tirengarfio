<?php use_helper('Javascript') ?>
<?php use_helper('ModalBox') ?>
<?php use_stylesheet('lista_mensajes.css') ?>

<div class="lista_mensajes">



    <?php foreach($mensajes_usuario as $m)?>

    <div class="mensaje_<?php echo (int)$m->getEstado()?>" id=<?php echo $m ?>>

        <div class="fotografia">

            <?php
            // mostramos el avatar del miembro que envió el mensaje y lo hacemos link para que podamos
            // ir hasta su perfil.
            echo link_to(image_tag(
            // ruta del archivo (avatar en miniatura)
            '/uploads/fotografias_miembros/'.$m->getUsuario()->getAvatarMensajes(),
            array( 'border' => 0)),
            // esta es la acción que se ejecutará al pulsar sobre el avatar (vamos a la página del perfil del miembro).
            'miembros/show?id='.$m->getUsuario()->getFotografia())
            ?>

        </div>

        <div class="cabecera_contenido_y_pie">

            <div class="cabecera_mensaje">

                <div class="info_mensaje">

                    <span class="titulo">
                        <?php echo $m->getTitulo() ?>
                    </span>

                    <div class="creado_en">
                        <?php echo $m->getCreatedAt() ?>
                    </div>

                </div>

                <div class="contenido" id="contenido_<?php echo $m ?>">

                    <?php

                    if(strlen($m->getContenidoParcial()) > 200) {

                        echo $m->getContenidoParcial();

                        echo link_to_remote('Ver más', array(

                        'url' => 'mensaje/mostrarContenido?contenido='.$m->getContenido(),

                        'update' => 'contenido_'.$m,

                        'loading' => visual_effect(''),

                        ));

                    }
                    else {
                        echo $m->getContenido();
                    }


                    ?>

                </div>

            </div>

            <div class="pie_mensaje">

                <div class="enlace_responder">

                    <?php echo m_link_to('Responder',
                    'mensaje/new?receptor='.$m->getUsuario()->getId(),
                    array('title' => ('Responder a '.$m->getUsuario()->getNombreApellidos())),
                    array('width' => 320, 'height' => 210)) ?>
                </div>

                <div class="enlace_leido">

                    <?php echo link_to_remote('Marcar como leido', array(

                    'url' => 'mensaje/cambiarEstadoLeido?id='.$m->getId(),

                    // Aqui se desplegará el resultado de la acción.
                    'update' => 'contenido_'.$m,

                    "complete" => "$('$m').toggleClassName('mensaje_1');",

                    )); ?>

                </div>

            </div>

        </div>

    </div>

</div>

