<?php use_stylesheet('lista_mensajes.css') ?>

<div class="lista_mensajes">

    <?php foreach($mensajes_usuario as $m) { ?>

    <div class="mensaje_<?php echo (int)$m->getEstado()?>" id=<?php echo $m ?>>

            <?php echo include_partial('mensaje', array('m' => $m)) ?>

    </div>

    <?php } ?>


    <?php foreach($solicitudes_amistad_recibidas as $s) { ?>

    <div class="solicitud_<?php echo $s?>" id=<?php echo $s ?>>

            <?php echo include_partial('solicitud_amistad', array('s' => $s)) ?>

    </div>

    <?php } ?>


</div>
    
    
    


    
    

