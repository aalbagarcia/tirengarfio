<?php 

class MensajeAbreviadoForm extends MensajeForm
{
  public function configure()
  {

    parent::configure(); 	
  	
  	$this->useFields(array('titulo','contenido'));

  	
  	
  }
  
}
  	
  	

