<?php

class myWidgetFormInputFileEditable extends sfWidgetFormInputFileEditable
{
	
	protected function configure($options = array(), $messages = array()){

		parent::configure();
		
		// aquí definimos el campo donde aparecerá el mensaje de error.
		$this->addOption('eliminar_archivo', false);
		
		
    }
	
}