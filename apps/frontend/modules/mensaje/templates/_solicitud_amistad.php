<div id="solicitud_<?php echo $s ?>" class="solicitud">

    <div class="fotografia">

        <?php


        // mostramos el avatar del miembro que envió el mensaje y lo hacemos link para que podamos
        // ir hasta su perfil.
        echo link_to(image_tag(

        
        
			        // ruta del archivo (avatar en miniatura)
			        '/uploads/fotografias_miembros/am_'.$s->getUser1()->getAvatar(),
			        array( 'border' => 0)),
			
			        // esta es la acción que se ejecutará al pulsar sobre el avatar (vamos a la página del perfil del miembro).
			        'miembros/show?id='.$s->getUser1()->getFotografia());

        ?>


    </div>

    <div id="texto_y_botones_<?php echo $s ?>" class="texto_y_botones">

        <div class="texto_solicitud">
        
	        <?php echo link_to( $s->getUser1()->getNombreApellidos(),'miembros/show?id='.$s->getUser1()->getId()) ?> quiere unirse a tu grupo de amigos.

        </div>

        <div class="boton_aceptar">

	        <?php
	        echo button_to_remote(
	            'Aceptar', array(
	        	'url' => 'amistad/aceptarAmistad?id_solicitud='.$s->getId(),
	            'update' => 'texto_y_botones_'.$s
	        ))
	        ?>
        </div>

        <div class="boton_denegar">

		    <?php
	        echo button_to_remote('Denegar', array(
		            'url' => 'amistad/denegarAmistad?id_solicitud='.$s->getId(),
		            'update' => 'texto_y_botones_'.$s
		        ))

                ?>
        </div>

</div>