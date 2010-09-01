<?php use_helper('I18N') ?>


<div id="contenedor_formularios">

   <div id="contenedor_formulario_inicio_sesion"> 
   
	<div id="formulario_inicio_sesion">

		<h2><?php echo __('Entra') ?></h2><br>
		
		<form action="<?php echo url_for('@sf_guard_signin') ?>" id="jander" method="post">
		  <table>
		    
		    <?php
		    // muestra el formulario
		    echo $formulario_autenticacion ?>
		    <tr>
			    <td>&nbsp;</td>
				<td>
				    <input type="submit" value="<?php echo __('sign in') ?>" />
			    </td>
			    
		    </tr>
		    		    
		  </table>
				
		</form>		
	    
	</div>
    <p>
             <a href="<?php echo url_for('sfApply/resetRequest') ?>"><?php echo __('Forgot your password?') ?></a>

    </p>
    </div>	    


	<div id="formulario_registro">


		<h2><?php echo __('Registrate') ?></h2><br>
			
		<form action="<?php echo url_for('sfApply/apply') ?>" method="post">
		  <table>
		    <?php echo $formulario_registro ?>
		    <tr>
			    <td>&nbsp;</td>
				<td>
		  			<input type="submit" value="<?php echo __('request') ?>" />
			    </td>
			    
		    </tr>
		  </table>
		
		</form>	
	
	</div>



</div>