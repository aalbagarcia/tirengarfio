<?php

/**
 * AmigoUsuario form base class.
 *
 * @method AmigoUsuario getObject() Returns the current form's model object
 *
 * @package    rs
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAmigoUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'user1_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User1'), 'add_empty' => true)),
      'user2_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User2'), 'add_empty' => true)),
      'estado'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user1_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User1'), 'required' => false)),
      'user2_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User2'), 'required' => false)),
      'estado'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('amigo_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AmigoUsuario';
  }

}
