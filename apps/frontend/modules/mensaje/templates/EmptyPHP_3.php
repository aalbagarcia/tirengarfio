<div class="lista_mensajes">

        <?php foreach($solicitudes_amistad_recibidas as $s) { ?>

        <div class="solicitud_<?php echo $s?>" id=<?php echo $s ?>>

                <?php echo include_partial('solicitud_amistad', array('s' => $s)) ?>

        </div>

            <?php } ?>

    </div>
