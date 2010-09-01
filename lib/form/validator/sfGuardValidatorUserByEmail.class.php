<?php

class sfGuardValidatorUserByEmail extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
     
  	$this->addOption('email_address_field', 'email_address');
    $this->addOption('password_field', 'password');
    $this->addOption('remember_checkbox', 'remember');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'The email and/or password is invalid.');
  }

  protected function doClean($values)
  {
    $email = isset($values[$this->getOption('email_address_field')]) ? $values[$this->getOption('email_address_field')] : '';
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';

    
    
    // user exists?
    if ($user = Doctrine::getTable('sfGuardUser')->findOneByEmailAddress($email))
    {
      // password is ok?

      if ($user->checkPassword($password))
      {

      	//die("entro");
      	
        return array_merge($values, array('user' => $user));
      }
    }
     
    if ($this->getOption('throw_global_error'))
    {

      throw new sfValidatorError($this, 'invalid');
    }
    
    
    throw new sfValidatorErrorSchema($this, array($this->getOption('email_address_field') => new sfValidatorError($this, 'invalid')));
  }
}

