<?php

class cambiarPasswordForm extends BaseForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'password_actual' => new sfWidgetFormInputPassword(),
      'password_nuevo' => new sfWidgetFormInputPassword(),
      'password_confirmacion' => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'password_actual' => new sfValidatorString(array(), array('required' => 'Este campo no puede quedar vacio')),
      'password_nuevo' => new sfValidatorString(
    								 array('min_length' => 6, 'max_length' => 128),
    								 array('required' => 'Este campo no puede quedar vacio',
    								       'min_length' => 'Debe tener al menos 6 caracteres',
    								       'max_length' => 'Debe tener menos de 128 caracteres')),
      'password_confirmacion' => new sfValidatorString(array(), array('required' => 'Este campo no puede quedar vacio'))
    ));

       
    
    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas.mio');
    
  	
  	
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                   new sfValidatorSchemaCompare('password_nuevo',
							                                   sfValidatorSchemaCompare::EQUAL,
							                                   'password_confirmacion', 
							                                   array(), 
							                                   array('invalid' => 'Los dos passwords no coinciden')),
    
    new ValidatorPasswordActual(array(), array('invalid' => 'Contraseña actual incorrecta.'))

    )));
    
    
    $this->widgetSchema->setLabel('password_confirmacion', 'Confirma tu nuevo password');
    
    $this->widgetSchema->setNameFormat('cambiar_password[%s]');
  }

  public function getModelName()
  {
    
  }
}
