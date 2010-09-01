<?php use_helper('Javascript') ?>
<?php use_javascript("misfunciones.js") ?>


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

            if(strlen($m->getContenidoParcial()) > 5) {

                echo $m->getContenidoParcial();

                echo link_to_remote('Ver más', array(

                'url' => 'mensaje/mostrarContenido?contenido='.$m->getContenido(),

                'update' => 'contenido_'.$m,


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


            <?php

            if((int)$m->getEstado() == 1){
                $cadena_estado_mensaje="leido";
            }
            else
            {
                $cadena_estado_mensaje="no leido";
            }
            echo link_to_remote('Marcar como leido', array(

            'url' => 'mensaje/cambiarEstadoLeido?id=1',  //.$m->getId(),

            // Aqui se desplegará el resultado de la acción.
            'update' => 'mensaje_'.$m,

            "complete" => "conmutarLeido_NoLeido('$m');",


            )); ?>


        </div>

    </div>

</div>