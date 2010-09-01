<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	
    $this->setWidgets(array(
      'email_address' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(array('type' => 'password')),
      'remember' => new sfWidgetFormInputCheckbox(),
    ));
    
    $this->setValidators(array(
      'email_address' => new sfValidatorEmail(array(), array('required' => 'E-mail is required')),
      'password' => new sfValidatorString(array(), array('required' => 'Password is required')),
      'remember' => new sfValidatorBoolean(),
    ));

    
    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas.mio');
    
    
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('form_autenticacion');

    
    if (sfConfig::get('app_sf_guard_plugin_allow_login_with_email', true))
    {
      $this->widgetSchema['email_address']->setLabel('E-Mail');
    }

    $this->validatorSchema->setPostValidator(new sfGuardValidatorUserByEmail());

    $this->widgetSchema->setNameFormat('signin[%s]');
  	
  }
}
