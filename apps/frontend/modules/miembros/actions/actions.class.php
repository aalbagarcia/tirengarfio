<?php 


/**
 * miembros actions.
 *
 * @package    rs
 * @subpackage miembros
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */




class miembrosActions extends sfActions
{

    
    public function executeEditarPassword(sfWebRequest $request)
    {
    	$this->form = new cambiarPasswordForm();
    	
    }
    
	public function executeGuardarPassword(sfWebRequest $request)
    {
    	$parametros_post = $request->getPostParameters();
    	
    	$this->form = new cambiarPasswordForm($parametros_post);
    	
    	$this->form->bind($request->getParameter($this->form->getName()));
    	
    	if ($this->form->isValid()) {
    		
    		$this->getUser()->setFlash('cambio_pass_ok', 'Has cambiado tu password');
    		
    		$this->getUser()->getGuardUser()->setPassword($parametros_post['cambiar_password']['password_nuevo']);
    		$this->getUser()->getGuardUser()->save();
    		
    	}
    	
        $this->setTemplate('editarPassword');
    	
    }
	
	public function executeIndex(sfWebRequest $request)
    {
    ///die("entroijfklsd");
    	
      // recuperamos el id del usuario de la sesión para que no aparezca nunca en el listado de usuarios.
      // como se puede ver a continuación, lo pasamos como opción en la creación del objeto filtro para luego
      // usarlo en el metodo doBuildQuery() (ver UsuarioFormFilter.class.php)
      $user_id = $this->getUser()->getGuardUser()->getId(); 
    	
      // Si se ha pulsado sobre la sección "Miembros" o un botón de paginación.
      if(!$request->isMethod('post')){

      	
           // Si se ha pulsado sobre un botón de paginación recuperamos 
           // el atributo 'miembros.filtro' que se guarda cuando pulsamos sobre
           // el boton "Filtrar". Ese atributo contiene los valores que habia en 
           // los widgets los cuales usaremos para que aparezcan de nuevo en el formulario.
           if($request->getParameter('page')){

           	   // Creamos un filtro con los valores que había en el formulario cuando se pulsó "Filtrar". 
		       $valores_widgets = $this->getUser()->getAttribute('miembros.filtro', array());
		       $this->filtro = new sfGuardUserProfileFormFilter($valores_widgets, array('user_id' => $user_id));
		       
		       // la query tendrá los valores de los widgets. 
		       $valores_query = $valores_widgets;
		        
		       
		   // Si se ha pulsado sobre la sección "Miembros".
           } else {
               
           	
           	   // Creamos un filtro con los widgets vacios. Al pasar el id del usuario de la sesión 
           	   // evitamos que este aparezca en la lista.
           	   $this->filtro = new sfGuardUserProfileFormFilter(array(), array('user_id' => $user_id));
           	
           	   // la query no tiene valores de filtración.
           	   $valores_query = array(); 
           	   
           	   // Guardamos los valores de los widgets para que se mantengan 
           	   // en el formulario cuando el usuario pulse un boton de paginación.
           	   $this->getUser()->setAttribute('miembros.filtro', NULL);

 
           }
                      

      // si se ha pulsado el boton "Filtrar".   
      } else {
      	
       	   // Guardamos los valores introducidos para filtrar. De ese modo, cuando pulsemos
    	   // sobre los controles de paginación se mantendran en el interior de los widgets.
      	   $this->getUser()->setAttribute('miembros.filtro', $request->getParameter('usuario_filters'));
          
           // Transformamos las edades introducidas en una fecha de nacimiento para que podamos 
    	   // filtrar, puesto que los que se almacena en las tablas es la fecha
    	   // de nacimiento y no la edad.       	  
           $valores_widgets =  $request->getParameter('usuario_filters');
      	
           
	       if(($valores_widgets['edad']['de'] != '') && $valores_widgets['edad']['a'] != '')
	       {
	    		    		
		        $datos_filtro =  $request->getParameter('usuario_filters');
		  	
		  	    
		        $anyo_fecha_nacimiento_desde =  date('Y') - $datos_filtro['edad']['a'] - 1;
		        $fecha_actual = date('Y-m-d');
		        $fecha_nacimiento_desde = str_replace ( date('Y'), $anyo_fecha_nacimiento_desde, $fecha_actual );          
		        
		        
		        $anyo_fecha_nacimiento_hasta =  date('Y') - $datos_filtro['edad']['de'];
		        $fecha_actual = date('Y-m-d');
		        $fecha_nacimiento_hasta = str_replace ( date('Y'), $anyo_fecha_nacimiento_hasta, $fecha_actual );
		
		        
		        $valores_widgets['fecha_nac']['from'] = $fecha_nacimiento_desde;
		        $valores_widgets['fecha_nac']['to'] = $fecha_nacimiento_hasta;
	
	       }else{
	    		
	    		$valores_widgets['fecha_nac']['from'] = NULL; 
	    		$valores_widgets['fecha_nac']['to'] = NULL;
    		
           }
           
                      
           // Creamos el filtro con los datos pasados, y pasamos el objeto usuario para evitar que
           // en la lista de los usuarios aparezca el usuario de la sesión (ver función doBuildQuery() 
           // en UsuarioFormFilter.class.php).
    	   $this->filtro = new UsuarioFormFilter($request->getParameter('usuario_filters'), array('user_id' => $user_id));

    	   // la query tendrá los valores introducidos en los widgets. 
	       $valores_query = $valores_widgets;
	       
      }     
      
            
      // construimos la query
      $this->lista_miembros = $this->filtro->buildQuery($valores_query);
      
            
      $this->pager = new sfDoctrinePager( 'Usuario', 3 ); // Table, items per page
	  $this->pager->setQuery( $this->lista_miembros ); // items query   
      $this->pager->setPage($this->getRequestParameter('page', 1)); // actual page
	  $this->pager->init();
      
      // Extraemos los ID de los miembros que son amigos del usuario.
      $this->amigos = sfGuardUserProfileTable::getAmigos($this->getUser()->getGuardUser()->getId())->execute();
      $this->id_amigos = sfGuardUserProfileTable::getIdMiembros($this->amigos);
      
      // Extraemos los ID de los miembros que estan pendientes de aceptacion o rechazo.
      $this->miembros_solicitud_amistad = sfGuardUserProfileTable::getMiembrosSolicitudAmistadEnviada($this->getUser()->getGuardUser()->getId())->execute();
      $this->id_miembros_solicitud_amistad = sfGuardUserProfileTable::getIdMiembros($this->miembros_solicitud_amistad); 

      
    }

  
  public function executeShow(sfWebRequest $request)
  {
    $this->usuario = Doctrine::getTable('sfGuardUserProfile')->find(array($request->getParameter('id')));
    //$this->usuario = $this->getRoute()->getObject();
    
    
    $this->forward404Unless($this->usuario);
    
    $this->amigos_miembro = sfGuardUserProfileTable::getAmigos($request->getParameter('id'))->execute();
    
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UsuarioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UsuarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($usuario = Doctrine::getTable('sfGuardUserProfile')->find(array($request->getParameter('id'))), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserProfileForm($usuario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($usuario = Doctrine::getTable('sfGuardUserProfile')->find(array($request->getParameter('id'))), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserProfileForm($usuario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($usuario = Doctrine::getTable('sfGuardUserProfile')->find(array($request->getParameter('id'))), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
    $usuario->delete();

    $this->redirect('miembros/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
    	
      $this->getUser()->setFlash('edicion_perfil_ok', 'Has actualizado tu perfil');
    	
    	
      $usuario = $form->save();

      $this->redirect('miembros/edit?id='.$usuario->getId());
    }
  }
}
