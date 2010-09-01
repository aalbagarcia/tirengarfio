<?php 

class ValidatorPasswordActual extends sfValidatorBase

{

	protected function configure($options = array(), $messages = array()){

		
		// aqui definimos el campo donde aparecerá el mensaje de error.
		$this->addOption('password_actual_field', 'password_actual');
		
		// aqui definimos el mensaje de error que se visualizará. 
		// EL PRIMERO DE LOS ARGUMENTOS ES EL "ERROR CODE" y el
		// segundo, el mensaje asociado a ese "error code".
		$this->addMessage('password_actual', 'Escribe correctamente tu contraseña');
		
    }
	
	
	protected function doClean($value){
		
		$password_almacenado = sfContext::getInstance()->getUser()->getGuardUser()->getPassword();
		
 		// Vamos a convertir el password introducido en "Password actual" a su version 
 		// encriptada a través de setPassword(). Tras aplicar setPassword(), la versión encriptada 
 		// del password queda almacenada en en objeto sfGuardUser. A continuacion "sacamos"
 		// el password encriptado del objecto sfGuardUser.
		sfContext::getInstance()->getUser()->getGuardUser()->setPassword($value['password_actual']);
		$password_introducido = sfContext::getInstance()->getUser()->getGuardUser()->getPassword();

		
		if($password_introducido != $password_almacenado){
			
			throw new sfValidatorErrorSchema(
		                        $this,
		                        array($this->getOption('password_actual_field') => new sfValidatorError($this, 'password_actual')));
			
		}
		
		
		
	}	
	
}
