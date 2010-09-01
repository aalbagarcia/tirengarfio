<?php use_javascript("misfunciones.js") ?>
<?php use_helper('Date') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/plugins/jquery-ui-1.7.3.custom.min.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/ui-lightness/jquery-ui-1.7.3.custom.css') ?>
<?php use_helper('jQuery') ?>

<div id="myDialog">

</div>

<div class="fotografia">

    <?php

    // mostramos el avatar del miembro que envió el mensaje y lo hacemos link para que podamos
    // ir hasta su perfil.
    echo link_to(image_tag(
			    // ruta del archivo (avatar en miniatura)
			    '/uploads/fotografias_miembros/am_'.$m->getsfGuardUserProfile()->getAvatar(),
			    array( 'border' => 0)),
			    // esta es la acción que se ejecutará al pulsar sobre el avatar (vamos a la página del perfil del miembro).
			    'miembros/show?id='.$m->getsfGuardUserProfile())
    ?>

</div>

<div class="cabecera_contenido_y_pie">

    <div class="cabecera_mensaje">

            <h2><?php echo $m->getTitulo() ?></h2>

            <h3><?php echo format_datetime($m->getCreatedAt(),'g') ?></h3>
        
    </div>

    <div class="contenido" id="contenido_<?php echo $m ?>">


        <p id="texto_abreviado_<?php echo $m?>">

                <?php echo $m->getContenidoParcial() ?>

<!--            <a href="#" onclick="conmutarContenido('<?php echo $m?>')" >Ver más</a>-->

                <?php echo link_to_function("Ver más", "conmutarContenido($m)")?>

        </p>

        <p id="texto_completo_<?php echo $m?>" style="display: none">

                <?php echo $m->getContenido() ?>

<!--                <a href="#" onclick="conmutarContenido('<?php echo $m?>')" >Ver menos</a>-->

                <?php echo link_to_function("Ver menos", "conmutarContenido($m)")?>
                
        </p>

    </div>

    <div class="pie_mensaje">

        <div class="enlace_responder">

            <?php

    						// link para enviar un mensaje ordinario
			                echo jq_link_to_remote('Responder', array(
                            // Esta es la acción (que no aparece en pantalla claro está...)
	                        // donde se llamará a la función para crear un solicitud de amistad.
	                        // Deberemos pasar el id del usuario de la sesión y el id del 
	                        // miembro al que vamos a mandar la solicitud.
	                        'url' => 'mensaje/new?receptor='.$m->getsfGuardUserProfile()->getId().'&tipo=0&estado=0',
	                                    
	                        // Aquí se desplegará el resultado de la acción.
	                        'update' => 'myDialog',
                                     
							// Lo de jQuery('#myDialog').dialog('open') y lo de autoOpen: false, lo
							// ponemos para que el dialogo modal se pueda abrir tantas veces como queramos.
			   			    'complete' => "jQuery('#myDialog').dialog({ width:375, height:220, top:123, 
			                                                            resizable:false, modal:true, autoOpen: false });
									                                                
			                 jQuery('#myDialog').dialog('open')"
                     ));
            ?>
        </div>

        <div class="enlace_leido" id="enlace_leido_<?php echo $m ?>">

            <?php 

            // mostramos el enlace que permite conmutar el estado del mensaje (leido/no leido)
            echo include_partial('enlace_conmutacion_estado', array('m' => $m))

            ?>


        </div>

    </div>

</div>