

<?php

echo $m;

echo link_to_remote('Marcar como '.$cadena_estado_mensaje, array(

            'url' => 'mensaje/cambiarEstadoLeido?id='.$sf_params->get('id') ,

            // Aqui se desplegará el resultado de la acción.
            'update' => 'enlace_leido_'.$mensajes_usuario[0] ,

            "complete" => "conmutarLeido_NoLeido('$mensajes_usuario[0]');",
))

?>
