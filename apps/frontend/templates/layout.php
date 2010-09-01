<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('layout.css') ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="contenedor">

            <div id="cabecera">

                <ul id="opciones_navegacion" >
                
                    <?php if($sf_context->getModuleName()=="miembros" && $sf_context->getActionName()=="show") { ?>
                
                        <li id="seleccionado">
                                <?php echo link_to('Perfil', 'miembros/show?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php }else { ?>
                        <li>
                                <?php echo link_to('Perfil', 'miembros/show?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php } ?>


                    <?php if($sf_context->getModuleName()=="amistad") { ?>
                    
                        <li id="seleccionado">
                                <?php echo link_to('Amigos', 'amistad/index?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php }else { ?>
                        <li>
                                <?php echo link_to('Amigos', 'amistad/index?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php } ?>


                    <?php if($sf_context->getModuleName()=="mensaje") { ?>
                        <li id="seleccionado">
                                <?php echo link_to('Mensajes', 'mensaje/index?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php }else { ?>
                        <li>
                                <?php echo link_to('Mensajes', 'mensaje/index?id='.$sf_user->getGuardUser()->getId()); ?>
                        </li>
                    <?php } ?>

                    <?php if($sf_context->getModuleName()=="miembro" && $sf_context->getActionName()=="index") { ?>
                        <li id="seleccionado">
                                <?php echo link_to('Gente', 'miembros/index'); ?>
                        </li>
                    <?php }else { ?>
                        <li>
                                <?php echo link_to('Gente', 'miembros/index'); ?>
                        </li>
                    <?php } ?>

                </ul>
                <ul id="opcion_salir">
                     <li>
                            <?php echo link_to('Salir', 'sfGuardAuth/signout') ?>
                    </li>

                </ul>

            </div>

       
			<div id="contenido">
            	<?php echo $sf_content ?>
			</div>

        </div>
  </body>
</html>


