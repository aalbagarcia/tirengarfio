<?php use_stylesheet('formularios.css') ?>
<?php use_stylesheet('main.css') ?>
<?php use_stylesheet('portada.css') ?>
 
<link rel="stylesheet" type="text/css" href="/rs2/web/css/main.css"> 
<link rel="stylesheet" type="text/css" href="/rs2/web/css/formularios.css"> 
<link rel="stylesheet" type="text/css" href="/rs2/web/css/portada.css"> 



<div id="contenedor_principal">

<div id="logo"></div>

<div id="contenedor_formularios">



	<div id="formulario_inicio_sesion">


		<?php 
		
		if(!isset($form_signin)){
				$form_signin = new sfGuardFormSigninByEmail();
		} 
		
		include_partial('sfGuardAuth/signin', array('form' => $form_signin));
		
		?>
	
	</div>



	<div id="formulario_registro">


		<h2>Regístrate</h2><br></br>
			
		<?php
		
		if(!isset($form_register)){
				$form_register = new sfGuardFormRegisterByOthers();
		}
		
		include_partial('sfGuardRegister/register', array('form' => $form_register)); 
		?>
	
	</div>

</div>

</div>