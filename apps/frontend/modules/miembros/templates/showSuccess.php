<?php use_stylesheet('perfil_mostrar.css') ?>
<?php use_helper('Date') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/plugins/jquery-ui-1.7.2.custom.min') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>
<?php use_helper('jQuery') ?>


<div id="myDialog">

</div>


<div id="foto">
        
        <?php
        echo link_to(image_tag(
        '/uploads/fotografias_miembros/'.$usuario->getAvatar()),
        'miembros/show?id='.$usuario->getId())
        ?>
        
</div>

<div id="datos_personales">

	        <p id="editar_o_mensaje">
	        
	            <?php
	            
	            if($sf_user->getGuardUser()->getId() == $usuario->getId()) {
	            	
	                echo link_to('Editar mi perfil', 'miembros/edit?id='.$usuario->getId(), array('id' => 'enlace_editar_perfil'));
	                 
	            } else {
	            	
         			// link para enviar un mensaje ordinario
					echo jq_link_to_remote('Enviale un mensaje', array(
                        
					    // Esta es la acción (que no aparece en pantalla claro está...)
                        // donde se llamará a la función para crear un solicitud de amistad.
                        // Deberemos pasar el id del usuario de la sesión y el id del 
                        // miembro al que vamos a mandar la solicitud.
                        'url' => 'mensaje/new?receptor='.$usuario->getId().'&tipo=0&estado=0',
                                    
                        // Aqui se desplegará el resultado de la acción.
                        'update' => 'myDialog',
                                     
					    // Lo de jQuery('#myDialog').dialog('open') y lo de autoOpen: false, lo
					    // ponemos para que el dialogo modal se pueda abrir tantas veces como queramos.
					    'complete' => "jQuery('#myDialog').dialog({ width:375, height:220, top:123, 
					                                                resizable:false, modal:true, autoOpen: false });
					                                                
					                   jQuery('#myDialog').dialog('open')"
                    ));
	            }
	            
	            ?>		
            </p>           
            
                 <h2 id="nombre_apellidos">
	                <?php echo $usuario->getFullname() ?>
	        </h2> 

            <br>&nbsp</br>  
            <p class="etiqueta_datos_personales" id="fecha_de_nacimiento">
                Fecha de nacimiento
            </p>

            <p class="valor_datos_personales" id="edad"><?php echo format_date($usuario->getfecha_nac(), 'D') ?>
                (<?php echo $usuario->getEdad() ?> años)
            </p>
            <p class="etiqueta_datos_personales" id="provincia">
            	Provincia
            </p>
            <p class="valor_datos_personales" id="provincia">
                <?php echo $usuario->getprovincia() ?>
            </p>
            <p class="etiqueta_datos_personales" id="localidad">
            	Localidad
            </p>
            <p class="valor_datos_personales" id="localidad">
                <?php echo $usuario->getlocalidad() ?>
            </p>

            <p id="actualizacion_perfil"><i>Ultima vez que actualizaste tu perfil:&nbsp <?php echo format_datetime($usuario->getUser()->getupdated_at(), 'g') ?></i>

			</p>



</div>


<div id="panel_amigos">

    <div id="cabecera_amigos">Amigos</div>

    <div id="cuadricula_amigos">

		<?php 
		if(!count($amigos_miembro)){ 
		?>
		
			<p>(no tienes amigos)</p>	   

		<?php
		}else{
			
        
	        // Creamos un iterador para poder manejar la coleccion.
	        // Lo necesito para poder crear la filas de la cuadricula de amigos
	        // porque con un foreach no se como avanzar de dos en dos.
	        $ite = $sf_data->getRaw('amigos_miembro')->getIterator();
	        
	        while($ite->valid()) {
	
	            $obj = $ite->current(); 
	            
	        ?>
	    
	        <div class="fila"> 
	    
	            <div class="foto_y_nombre">
	    
	                    <?php echo link_to(
	                    image_tag(
	                    '/uploads/fotografias_miembros/aa_'.$obj->getAvatar(),
	                    array( 
	                    'class' => 'foto_amigo',
	                    'border' => 0)),
	                    
	                    'miembros/show?id='.$obj->getId()) ;
	                    ?>
	    
	                <div class="nombre_amigo">
	    
	                        <?php echo $obj->getFullname(); ?>
	    
	                </div>
	    
	            </div>
	    
	                <?php 
	                $obj = $ite->next();
	                
	                $obj = $ite->current();
	                
	                if($ite->valid()) {
	                    
	                    ?>
	        
	            <div class="foto_y_nombre">
	        
	                        <?php echo link_to(
	                        image_tag(
	                        '/uploads/fotografias_miembros/aa_'.$obj->getAvatar(),
	                        array( 
	                        'class' => 'foto_amigo',
	                        'border' => 0)),
	                        
	                        'miembros/show?id='.$obj->getId()) ; ?>
	        
	        
	                <div class="nombre_amigo">
	                            <?php echo $obj->getFullname(); ?>
	                </div>
	        
	        
	            </div>
	        
	        
	                    <?php 
	                    $obj = $ite->next();
	                    
	                } ?>
	    
	        </div>
    
            <?php }

        }?>


		
		

    </div>
</div>
