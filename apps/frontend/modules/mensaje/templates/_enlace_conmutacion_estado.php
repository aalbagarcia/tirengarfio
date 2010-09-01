<?php use_javascript('/sfProtoculousPlugin/js/prototype.js') ?>
<?php use_javascript('/sfProtoculousPlugin/js/scriptaculous.js') ?>
<?php use_javascript('misfunciones.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/plugins/jquery-ui-1.7.2.custom.min.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>
<?php use_helper('jQuery') ?>

<?php
            if((int)$m->getEstado() == 1) {

                $cadena_estado_mensaje="no leido";
            }
            else {
                $cadena_estado_mensaje="leido";	
            }
            
            echo jq_link_to_remote('Marcar como '.$cadena_estado_mensaje, array(

                    'url' => 'mensaje/cambiarEstadoLeido?id='.$m->getId(),

                    // Aqui se desplegará el resultado de la acción.
                    'update' => 'enlace_leido_'.$m,

                    "complete" => "conmutarLeido_NoLeido('$m');",
            ));
?>
