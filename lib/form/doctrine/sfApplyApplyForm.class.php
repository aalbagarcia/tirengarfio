<?php

class sfApplyApplyForm extends sfGuardUserProfileForm
{
  private $validate = null;

  public function configure()
  {
    parent::configure();

    
    
    // We're making a new user or editing the user who is
    // logged in. In neither case is it appropriate for
    // the user to get to pick an existing userid. The user
    // also doesn't get to modify the validate field which
    // is part of how their account is verified by email.

    unset($this['user_id'], $this['validate'], $this['slug']);

    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas2.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas2.mio');
    
    $this->setWidget('username', new sfWidgetFormInputHidden());
    $this->setWidget('provincia', new sfWidgetFormInputHidden()); 
    $this->setWidget('localidad', new sfWidgetFormInputHidden());
    $this->setWidget('avatar', new sfWidgetFormInputHidden());
    
    $this->setDefault('username', 'xXxXxXxXx');
    
    
    $years = range(date('Y'),1900);
    $this->setWidget('fecha_nac', new sfWidgetFormI18nDate(array('culture' => 'es_ES',
    												'years' => array_combine($years, $years),
    												'empty_values' => array('day' => 'Dia', 'month' => 'Mes', 'year' => 'Año')))
    );
    
    $this->setWidget('sexo', new sfWidgetFormChoice(array('choices' => array(0 => 'Chica' , 1 => 'Chico'),
    										      'expanded' => true,
    										      'multiple' => false ))
    
    );
    
    // Add username and password fields which we'll manage
    // on our own. Before you ask, I experimented with separately 
    // emitting, merging or embedding a form subclassed from 
    // sfGuardUser. It was vastly more work in every instance.
    // You have to clobber all of the other fields (you can 
    // automate that, but still). If you use embedForm you realize 
    // you've got a nested form that looks like a
    // nested form and an end user looking at that and
    // saying "why?" If you use mergeForm you can't save(). And if
    // you output the forms consecutively you have to manage your
    // own transactions. Adding two fields to the profile form
    // is definitely simpler.



    $this->setWidget('password', new sfWidgetFormInputPassword(
      array(), array('maxlength' => 128)
    ));
    
    $this->widgetSchema->moveField('password', sfWidgetFormSchema::AFTER, 'username');

    $this->setWidget('password2', new sfWidgetFormInputPassword(
      array(), array('maxlength' => 128)
    ));
    
    $this->widgetSchema->moveField('password2', sfWidgetFormSchema::AFTER, 'password');
    
    $this->widgetSchema->setLabels(array('password2' => 'Confirm Password'));

    $email = $this->getWidget('email');
    $class = get_class($email);
    $this->setWidget('email2', new $class(
      array(), array('maxlength' => $email->getAttribute('maxlength'))
    ));
    
    $this->widgetSchema->moveField('email2', sfWidgetFormSchema::AFTER, 'email');

    $this->widgetSchema->setLabels(array(
      'fullname' => 'Full Name',
      'email2' => 'Confirm Email'
    ));

    $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
  	$this->widgetSchema->addFormFormatter('tablas2.mio', $decorator);
  	$this->widgetSchema->setFormFormatterName('tablas2.mio');
    
    $this->widgetSchema->setNameFormat('sfApplyApply[%s]');
    

    
    // We have the right to an opinion on these fields because we
    // implement at least part of their behavior. Validators for the
    // rest of the user profile come from the schema and from the
    // developer's form subclass
    
    $this->setValidator('username',
      new sfValidatorAnd(array(
        new sfValidatorString(array(
          'required' => true,
          'trim' => true,
          'min_length' => 4,
          'max_length' => 16
        )),
        // Usernames should be safe to output without escaping and generally username-like.
        new sfValidatorRegex(array(
          'pattern' => '/^\w+$/'
        ), array('invalid' => 'Usernames must contain only letters, numbers and underscores.')),
        new sfValidatorDoctrineUnique(array(
          'model' => 'sfGuardUser',
          'column' => 'username'
        ), array('invalid' => 'There is already a user by that name. Choose another.'))
      ))
    );
    
    
    
    // Passwords are never printed - ever - except in the context of Symfony form validation which has built-in escaping.
    // So we don't need a regex here to limit what is allowed
    
    // Don't print passwords when complaining about inadequate length
    $this->setValidator('password', new sfValidatorString(array(
      'required' => true,
      'trim' => true,
      'min_length' => 6,
      'max_length' => 128
    ), array(
      'required' => 'Password is required',
      'min_length' => 'That password is too short. It must contain a minimum of %min_length% characters.')));
        
    $this->setValidator('password2', new sfValidatorString(array(
      'required' => true,
      'trim' => true,
      'min_length' => 6,
      'max_length' => 128
    ), array(
      'required' => 'You must repeat your password',
      'min_length' => 'That password is too short. It must contain a minimum of %min_length% characters.')));

    // Be aware that sfValidatorEmail doesn't guarantee a string that is preescaped for HTML purposes.
    // If you choose to echo the user's email address somewhere, make sure you escape entities.
    // <, > and & are rare but not forbidden due to the "quoted string in the local part" form of email address
    // (read the RFC if you don't believe me...).
    
   $this->setValidator('email', new sfValidatorAnd(array(
      new sfValidatorEmail(array('required' => true, 'trim' => true)),
      new sfValidatorString(array('required' => true, 'max_length' => 80)),
      new sfValidatorDoctrineUnique(array(
         'model' => 'sfGuardUserProfile',
         'column' => 'email'
   ), array(
     'invalid' => 'An account with that email address already exists. If you have forgotten your password, click "cancel", then "Reset My Password."'))
 ), array(), array('required' => 'E-mail is required')));
    
     
    $this->setValidator('email2', new sfValidatorEmail(array(
      'required' => true,
      'trim' => true
    ), array(
      'required' => 'You must repeat your e-mail')));

    // Disallow <, >, & and | in full names. We forbid | because 
    // it is part of our preferred microformat for lists of disambiguated
    // full names in sfGuard apps: Full Name (username) | Full Name (username) | Full Name (username)
    $this->setValidator('fullname', new sfValidatorAnd(array(
      new sfValidatorString(array(
        'required' => true,
        'trim' => true,
        'min_length' => 6,
        'max_length' => 128)),
        new sfValidatorRegex(array(
          'pattern' => '/^[^<>&\|]+$/',
        ), array('invalid' => 'Full names may not contain &lt;, &gt;, | or &amp;.'))
    ), array(), array('required' => 'Full name is required')));
    
    $this->setValidator('sexo', new sfValidatorChoice(array('choices' => array(0,1)), array('required' => 'Sex is required')));
    
    $this->setValidator('fecha_nac', new sfValidatorDate(array('max' => (date('Y')-14).'-'.date('m').'-'.date('d')),
                                         array('required' => 'Date of birth is required.',
                          				       'max' => 'You must be older than 14 years old')));
    
    $schema = $this->validatorSchema;
    
    // Hey Fabien, adding more postvalidators is kinda verbose!
    $postValidator = $schema->getPostValidator();
    
    $postValidators = array(
      new sfValidatorSchemaCompare(
        'password',
        sfValidatorSchemaCompare::EQUAL,
        'password2',
        array(),
        array('invalid' => 'The passwords did not match.')
      ),
      new sfValidatorSchemaCompare(
        'email',
        sfValidatorSchemaCompare::EQUAL,
        'email2',
        array(),
        array('invalid' => 'The email addresses did not match.')
      )
    );
    
    if ($postValidator)
    {
      $postValidators[] = $postValidator;
    }
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));
    
    
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('form_registro');
    
    $this->widgetSchema->setLabel('fecha_nac', 'Fecha de nacimiento');
    
  }
    
  public function setValidate($validate)
  {
    $this->validate = $validate;
  }
  
  public function doSave($con = null)
  {
    $user = new sfGuardUser();
    $user->setUsername($this->getValue('username'));
    $user->setPassword($this->getValue('password'));
    $user->setEmailAddress( $this->getValue('email') );
    // They must confirm their account first
    $user->setIsActive(false);
    $user->save();
    $this->userId = $user->getId();
    
    return parent::doSave($con);
  }
  
  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    $object->setUserId($this->userId);
    $object->setValidate($this->validate);

    // Don't break subclasses!
    return $object;
  }
  
   /**
   * Sets a value for a form field.
   *
   * @param string $field	The field name
   * @param mixed  $value	The default value
   */
    public function setValue($field, $value){

    	if(!in_array($field, array_keys($this->values))){

    		throw new sfException(sprintf('Unkown field" "%s" in "%s" object.', $field, get_class($this)));
    	}

    	$this->values[$field] = $value;
    }
    
  
}

