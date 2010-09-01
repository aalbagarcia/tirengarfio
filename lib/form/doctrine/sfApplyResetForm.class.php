<?php

class sfApplyResetForm extends sfForm
{
  public function configure()
  {
    $this->setWidget('password',
      new sfWidgetFormInputPassword(
        array(), array('maxlength' => 128)));
    
    $this->setWidget('password2',
      new sfWidgetFormInputPassword(
        array(), array('maxlength' => 128)));
    
        
           
    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas2.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas2.mio');
     
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('form_reset');
    
    
    
    $this->widgetSchema->setLabels(array(
      'password' => 'Choose NEW Password',
      'password2' => 'Confirm NEW Password'));
    
    $this->widgetSchema->setNameFormat('sfApplyReset[%s]');
    
    
    
    $this->setValidator('password',
      new sfValidatorString(array('required' => true,
        'trim' => true,
        'min_length' => 6,
        'max_length' => 128), array(
          'min_length' => 'That password is too short. It must contain a minimum of %min_length% characters.')));
    
    $this->setValidator('password2', 
      new sfValidatorString(array('required' => true,
        'trim' => true,
        'min_length' => 6,
        'max_length' => 128), array(
          'min_length' => 'That password is too short. It must contain a minimum of %min_length% characters.')));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorSchemaCompare(
        'password', sfValidatorSchemaCompare::EQUAL, 'password2',
        array(), array('invalid' => 'The passwords did not match.')));
  }
}

