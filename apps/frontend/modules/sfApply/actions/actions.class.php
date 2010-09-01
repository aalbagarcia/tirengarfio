<?php 

    require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineApplyPlugin/modules/sfApply/lib/BasesfApplyActions.class.php');

    class sfApplyActions extends BasesfApplyActions
    {
      
   public function executeAutenticacionYRegistro(sfWebRequest $request)
   {
   	
    
  	$param = $request->getPostParameters();
  	// el nombre del formulario es el que se le data en setNameFormat()
  	$nombre_formulario = array_keys($param);
  	
  	// si se ejecuta esta acción porque se ha pulsado el boton submit
  	// recuperamos el formulario submitido para que aparezcan 
  	// los mensajes de error. En caso contrario el formulario aparecera vacio.  
  	if($request->isMethod('post') && $nombre_formulario[0]=='signin'){
  		 
  	 	$this->formulario_autenticacion =  $this->getUser()->getAttribute('formulario_autenticacion');
        $this->formulario_registro = new sfApplyApplyForm();
  	 	
    } elseif($request->isMethod('post') && $nombre_formulario[0]=='sfApplyApply') {
   	
    	$this->formulario_registro =  $this->getUser()->getAttribute('formulario_registro');

    	$this->formulario_autenticacion = new sfGuardFormSignin();
    	
	} else {
		
		$this->formulario_registro = new sfApplyApplyForm();
		$this->formulario_autenticacion = new sfGuardFormSignin();
		
	} 
  	  	
  }
    	
    	
      public function executeApply(sfRequest $request)
      {

      	
        $this->form = $this->newForm('sfApplyApplyForm');
        if ($request->isMethod('post'))
        {
          $this->form->bind($request->getParameter('sfApplyApply'));
          if ($this->form->isValid())
          {
          	
          	
            $guid = "n" . self::createGuid();
            $this->form->setValidate($guid);
            
            
            $this->form->setValue('username','xXxXxXx');

            
            $this->form->save();
            try
            {
              $profile = $this->form->getObject();
              $this->mail(array('subject' => sfConfig::get('app_sfApplyPlugin_apply_subject',
                  sfContext::getInstance()->getI18N()->__("Please verify your account on %1%", array('%1%' => $this->getRequest()->getHost()))),
                'fullname' => $profile->getFullname(),
                'email' => $profile->getEmail(),
                'parameters' => array('fullname' => $profile->getFullname(), 'validate' => $profile->getValidate()),
                'text' => 'sfApply/sendValidateNewText',
                'html' => 'sfApply/sendValidateNew'));
              return 'After';
            }
            catch (Exception $e)
            {
              //$mailer->disconnect();
              $profile = $this->form->getObject();
              $user = $profile->getUser();
              $user->delete();
                // You could re-throw $e here if you want to
              // make it available for debugging purposes
              return 'MailerError';
            }
          }
          
          //die("entrofsdffasdfa");
	      // Si los datos introducidos en el formulario no son validos, los guardamos
	      // para que aparezcan los mensajes de error. Se puede añadir el código
	      // para que los campos se vacien cada vez que no se introducen bien los valores.
	      $this->getUser()->setAttribute('formulario_registro', $this->form);
	      return $this->forward('sfApply', 'autenticacionYRegistro');
        }
      }
     
      protected function mail($options) {
        $required = array('subject', 'parameters', 'email', 'fullname', 'html', 'text');
        foreach ($required as $option)
        {
          if (!isset($options[$option]))
          {
            throw new sfException("Required option $option not supplied to sfApply::mail");
          }
        }
        $message = $this->getMailer()->compose();
        $message->setSubject($options['subject']);
       
        // Render message parts
        $message->setBody($this->getPartial($options['html'], $options['parameters']), 'text/html');
        $message->addPart($this->getPartial($options['text'], $options['parameters']), 'text/plain');
        $address = $this->getFromAddress();
        $message->setFrom(array($address['email'] => $address['fullname']));
        $message->setTo(array($options['email'] => $options['fullname']));
        $this->getMailer()->send($message);
      }
      
  public function executeResetRequest(sfRequest $request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      $guardUser = $this->getUser()->getGuardUser();
      $this->forward404Unless($guardUser);
      return $this->resetRequestBody($guardUser);
    }
    else
    {
      $this->form = $this->newForm('sfApplyResetRequestForm');
      if ($request->isMethod('post'))
      {
        $this->form->bind($request->getParameter('sfApplyResetRequest'));
        if ($this->form->isValid())
        {
        	
        
          // The form matches unverified users, but retrieveByUsername does not, so
          // use an explicit query. We'll special-case the unverified users in
          // resetRequestBody
          
          $email = $this->form->getValue('email');
          

          if (strpos($email, '@') !== false)
          {
          	
            $user = Doctrine::getTable('sfGuardUser')->createQuery('u')->innerJoin('u.Profile p')->where('p.email = ?', $email)->fetchOne();
            
          }
          else
          {
            $user = Doctrine::getTable('sfGuardUser')->createQuery('u')->where('username = ?', $email)->fetchOne();
          }
          
          
          return $this->resetRequestBody($user);
        }
      }
    }
  }
      
      
      static protected function createGuid()
  {
    $guid = "";
    // This was 16 before, which produced a string twice as
    // long as desired. I could change the schema instead
    // to accommodate a validation code twice as big, but
    // that is completely unnecessary and would break 
    // the code of anyone upgrading from the 1.0 version.
    // Ridiculously unpasteable validation URLs are a 
    // pet peeve of mine anyway.
    for ($i = 0; ($i < 8); $i++) {
      $guid .= sprintf("%02x", mt_rand(0, 255));
    }
    return $guid;
  }
      
    }
