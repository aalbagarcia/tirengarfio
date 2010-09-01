<?php use_helper('Javascript') ?>

<?php

if($estado == 0) {

    echo $m->getContenidoParcial();
    $cadena_estado_contenido = "Ver más";
    $estado = 1;

}
else {
    echo $m->getContenido();
    $cadena_estado_contenido = " Ver menos";
    $estado = 0;
}


echo link_to_remote($cadena_estado_contenido, array(

'url' => 'mensaje/cambiarEstadoContenido?id='.$m->getId().'&estado='.$estado,

'update' => 'contenido_'.$m,

));

?>  