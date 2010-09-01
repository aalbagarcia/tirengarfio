<?php

/**
 * mensaje actions.
 *
 * @package    rs
 * @subpackage mensaje
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mensajeActions extends sfActions {



    public function executeIndex(sfWebRequest $request) {

        // Llamamos a la función que extrae los mensajes que le han enviado al usuario.
        $this->mensajes_usuario = MensajeTable::getMensajesUsuario($this->getUser()->getGuardUser()->getId());

        // Llamamos a la función que extrae las solicitudes de amistad recibidas.
        $this->solicitudes_amistad_recibidas = AmigoUsuarioTable::getSolicitudesAmistadRecibidas($this->getUser()->getGuardUser()->getId());
        
    }

    
    public function executeShow(sfWebRequest $request) {
        $this->mensaje = Doctrine::getTable('Mensaje')->find($request->getParameter('id'));
        $this->forward404Unless($this->mensaje);
    }


    public function executeMostrarContenido(sfWebRequest $request) {

        $this->texto_mensaje = $request->getParameter('contenido');

    }

    
    public function executeCambiarEstadoLeido(sfWebRequest $request) {

        // buscamos el mensaje que se quiere cambiar de estado.
        $this->mensajes_usuario = Doctrine::getTable('Mensaje')->findById($request->getParameter('id'));


        // cambiamos el estado del mensaje.
        if($this->mensajes_usuario[0]->getEstado() == 1) {
        	
            $this->mensajes_usuario[0]->setEstado(0);
            
        }
        else {
        	
            $this->mensajes_usuario[0]->setEstado(1);
        }

        // salvamos el estado en la bd.
        $this->mensajes_usuario[0]->save();

        // renderizamos el parcial que muestra
        return $this->renderPartial('mensaje/enlace_conmutacion_estado', array( 'm' => $this->mensajes_usuario[0]));

    }


    public function executeCambiarEstadoContenido(sfWebRequest $request) {

    	
        $this->mensajes_usuario = Doctrine::getTable('Mensaje')->findById($request->getParameter('id'));

        
        return $this->renderPartial('mensaje/contenido', array(
                'm'  => $this->mensajes_usuario[0],
                'estado' => $request->getParameter('estado')

        ));


    }

    public function executeNew(sfWebRequest $request) {

	    $m = new Mensaje();
	    
	    $m->setsfGuardUserProfileId($this->getUser()->getGuardUser()->getId());
	    $m->setReceptor($request->getParameter('receptor'));
	    $m->setTipo($request->getParameter('tipo'));
        $m->setEstado($request->getParameter('estado'));
	    
	    
	    $this->form = new MensajeForm($m);
    	
           
    }


    public function executeCreate(sfWebRequest $request) {
        
    	$this->forward404Unless($request->isMethod('post'));

        $this->form = new MensajeForm();
        
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
        
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($mensaje = Doctrine::getTable('Mensaje')->find($request->getParameter('id')), sprintf('Object mensaje does not exist (%s).', $request->getParameter('id')));
        $this->form = new MensajeForm($mensaje);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
        $this->forward404Unless($mensaje = Doctrine::getTable('Mensaje')->find($request->getParameter('id')), sprintf('Object mensaje does not exist (%s).', $request->getParameter('id')));
        $this->form = new MensajeForm($mensaje);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($mensaje = Doctrine::getTable('Mensaje')->find($request->getParameter('id')), sprintf('Object mensaje does not exist (%s).', $request->getParameter('id')));
        $mensaje->delete();

        $this->redirect('mensaje/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        
        if ($form->isValid()) {

        	    
        	$mensaje = $form->save();

            $this->redirect($request->getReferer());
        }
    }
}
