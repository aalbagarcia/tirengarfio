
<?php use_helper('Pagination') ?>
<?php use_stylesheet('lista_miembros.css') ?>
<?php use_javascript('miscript.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/plugins/jquery-ui-1.7.2.custom.min.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>
<?php use_helper('jQuery') ?>


<div id="myDialog">

</div>


<div id="lista_<?php echo $sf_context->getModuleName() ?>">

    <div id="cabecera_lista">


                         <h3 id="texto_cabecera">
                 <?php
                 if($sf_context->getModuleName() == 'miembros'){?>

                        &nbsp&nbsp <?php echo $pager->getNbResults() ?> resultados

                 <?php }else{ ?>

                        &nbsp Tienes <?php echo $pager->getNbResults() ?> amigos

                 <?php }?>
                 </h3>


        <div id='botones_paginas_arriba'>

            <?php

                // 'pager_navigation' es la función que está dentro del helper PaginationHelper.php.
                echo pager_navigation($pager, $sf_context->getModuleName().'/index/')
            ?>
        </div>

    </div>


    <div id="cuerpo_lista">

        <?php foreach ($lista_miembros as $miembro): ?>

        <div class="miembro">

         <div class="fotografia">

                    <?php

                    $ruta_imagen = 'al_'.$miembro->getAvatar();

                    echo link_to(image_tag('/uploads/fotografias_miembros/'.$ruta_imagen, array('border' => 0)),
                                 'miembros/show?id='.$miembro->getId());

                    ?>

            </div>

            <div class="datos_y_acciones">

                <div class="datos">

                    <div class="nombre_apellidos">

                            <?php echo $miembro->getFullname() ?>

                    </div>

                    <div class="edad">

                                Edad: <?php echo $miembro->getEdad() ?>

                    </div>

                    <div class="residencia">

                            <?php

                            echo $miembro->getLocalidad().', '.$miembro->getProvincia();

                            ?>

                    </div>
                </div>

                <div class="acciones">
        
        
                        <?php if($sf_context->getModuleName() == 'miembros'): ?>

                    <div id="solicitud_amistad_<?php echo $miembro->getId() ?>">

                                <?php

                                if (in_array($miembro->getId(), $sf_data->getRaw('id_amigos'))) {

                                    echo "Es tu amigo";

                                }
                                elseif (in_array($miembro->getId(), $sf_data->getRaw('id_miembros_solicitud_amistad'))) {

                                    echo "Solicitud de amistad pendiente de aceptación";

                                }
                                else {

                                    echo jq_link_to_remote('Enviar solicitud de amistad', array(
        
                                     // Esta es la acción (que no aparece en pantalla claro está...)
                                            // donde se llamará a la funcion para crear un solicitud de amistad.
                                            // Deberemos pasar el id del usuario de la sesion y el id del
                                            // miembro al que vamos a mandar la solicitud.
                                            'url' => 'amistad/nueva?receptor='.$miembro->getId(),

                                            // Aquí se desplegará el resultado de la acción.
                                            'update' => 'solicitud_amistad_'.$miembro->getId(),

                                    ));

                                }

                                ?>

                    </div>

                        <?php endif?>

                          <?php

                                        // link para enviar un mensaje ordinario
                                        echo jq_link_to_remote('Enviar mensaje', array(
                                        // Esta es la acción (que no aparece en pantalla claro está...)
                                            // donde se llamará a la función para crear un solicitud de amistad.
                                            // Deberemos pasar el id del usuario de la sesión y el id del
                                            // miembro al que vamos a mandar la solicitud.
                                            'url' => 'mensaje/new?receptor='.$miembro->getId().'&tipo=0&estado=0',

                                            // Aqui se desplegará el resultado de la acción.
                                            'update' => 'myDialog',

                                            // Lo de jQuery('#myDialog').dialog('open') y lo de autoOpen: false, lo
                                            // ponemos para que el dialogo modal se pueda abrir tantas veces como queramos.
                                            'complete' => "jQuery('#myDialog').dialog({ width:375, height:220, top:123,
                                                                                        resizable:false, modal:true, autoOpen: false });
														   jQuery('#myDialog').dialog('open')"
                                    ));

?>

                </div>

            </div>

        </div>
                                    
                                            <?php endforeach; ?>

    </div>

           <div id='botones_paginas_abajo'>

            <?php

                // 'pager_navigation' es la función que está dentro del helper PaginationHelper.php.
                echo pager_navigation($pager, $sf_context->getModuleName().'/index/')
            ?>
        </div>


</div>
                                    