<?php

class sfApplyResetRequestForm extends sfForm
{
  public function configure()
  {
    parent::configure();

    
    $this->setWidget('email',
      new sfWidgetFormInput(
        array(), array('maxlength' => 100)));

        
    $this->setValidator('email',
      new sfValidatorOr(
        array(
          new sfValidatorAnd(
            array(
              new sfValidatorString(array('required' => true,
                'trim' => true,
                'min_length' => 4,
                'max_length' => 16)),
              new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser',
                'column' => 'username'), array("invalid" => "There isn't any account using that e-mail")))),
          new sfValidatorEmail(array('required' => true), array('invalid' => "That's not an e-mail address" ))),
        array(),
        array('required' => 'E-mail is required')));
        
          
    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas2.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas2.mio');
          
  	$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('form_reset_request');
  	
          
    $this->widgetSchema->setLabel('email', 'E-mail');
          
    $this->widgetSchema->setNameFormat('sfApplyResetRequest[%s]');

  }
}

