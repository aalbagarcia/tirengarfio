<?php use_helper('Javascript') ?>

<?php

	echo $texto_mensaje;

         echo link_to_remote('Ver menos', array(

                'url' => 'mensaje/mostrarContenidoAbreviado?contenido='.$m->getContenido(),

                'update' => 'contenido_'.$m,


                ));

?>
