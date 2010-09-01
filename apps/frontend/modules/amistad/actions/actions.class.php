<?php

/**
 * amistad actions.
 *
 * @package    rs
 * @subpackage amistad
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class amistadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

    // Extraemos los amigos del usuario.
    $this->amigos_usuario = sfGuardUserProfileTable::getAmigos($this->getUser()->getGuardUser()->getId());
      
    $this->pager = new sfDoctrinePager( 'sfGuardUserProfile', 3 ); // Table, items per page
	$this->pager->setQuery( $this->amigos_usuario ); // items query   
	$this->pager->setPage($this->getRequestParameter('page', 1)); // actual page
	$this->pager->init();
    
  }


  public function executeNueva(sfWebRequest $request)
  {

	$amistad = new AmigoUsuario();
     
    $amistad->setuser1_id($this->getUser()->getGuardUser()->getId());
    $amistad->setuser2_id($request->getParameter('receptor'));
	$amistad->setEstado(0);

	$amistad->save();

  }

public function executeAceptarAmistad(sfWebRequest $request){
   
    $this->solicitud = Doctrine::getTable('AmigoUsuario')->findOneById($request->getParameter('id_solicitud'));

    $this->solicitud->setEstado(1);

    $this->solicitud->save();

    
}

public function executeDenegarAmistad(sfWebRequest $request){

    $this->solicitud = Doctrine::getTable('AmigoUsuario')->findOneById($request->getParameter('id_solicitud'));

    $this->solicitud->delete();

    

}


public function executeShow(sfWebRequest $request)
  {
    $this->amigo_usuario = Doctrine::getTable('AmigoUsuario')->find(array($request->getParameter('user1'),
                                        $request->getParameter('user2')));
    $this->forward404Unless($this->amigo_usuario);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AmigoUsuarioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AmigoUsuarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($amigo_usuario = Doctrine::getTable('AmigoUsuario')->find(array($request->getParameter('user1'),
                  $request->getParameter('user2'))), sprintf('Object amigo_usuario does not exist (%s).', $request->getParameter('user1'),
                  $request->getParameter('user2')));
    $this->form = new AmigoUsuarioForm($amigo_usuario);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($amigo_usuario = Doctrine::getTable('AmigoUsuario')->find(array($request->getParameter('user1'),
                  $request->getParameter('user2'))), sprintf('Object amigo_usuario does not exist (%s).', $request->getParameter('user1'),
                  $request->getParameter('user2')));
    $this->form = new AmigoUsuarioForm($amigo_usuario);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($amigo_usuario = Doctrine::getTable('AmigoUsuario')->find(array($request->getParameter('user1'),
                  $request->getParameter('user2'))), sprintf('Object amigo_usuario does not exist (%s).', $request->getParameter('user1'),
                  $request->getParameter('user2')));
    $amigo_usuario->delete();

    $this->redirect('amistad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $amigo_usuario = $form->save();

      $this->redirect('amistad/edit?user1='.$amigo_usuario->getUser1().'&user2='.$amigo_usuario->getUser2());
    }
  }
}
