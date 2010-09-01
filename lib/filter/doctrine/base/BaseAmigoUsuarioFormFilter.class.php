<?php

/**
 * AmigoUsuario filter form base class.
 *
 * @package    rs
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAmigoUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user1_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User1'), 'add_empty' => true)),
      'user2_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User2'), 'add_empty' => true)),
      'estado'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user1_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User1'), 'column' => 'id')),
      'user2_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User2'), 'column' => 'id')),
      'estado'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('amigo_usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AmigoUsuario';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'user1_id' => 'ForeignKey',
      'user2_id' => 'ForeignKey',
      'estado'   => 'Number',
    );
  }
}
