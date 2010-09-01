<?php

/**
 * Mensaje filter form base class.
 *
 * @package    rs
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMensajeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_user_profile_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUserProfile'), 'add_empty' => true)),
      'receptor'                 => new sfWidgetFormFilterInput(),
      'tipo'                     => new sfWidgetFormFilterInput(),
      'titulo'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contenido'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'estado'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'sf_guard_user_profile_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUserProfile'), 'column' => 'id')),
      'receptor'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tipo'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'titulo'                   => new sfValidatorPass(array('required' => false)),
      'contenido'                => new sfValidatorPass(array('required' => false)),
      'estado'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('mensaje_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensaje';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'sf_guard_user_profile_id' => 'ForeignKey',
      'receptor'                 => 'Number',
      'tipo'                     => 'Number',
      'titulo'                   => 'Text',
      'contenido'                => 'Text',
      'estado'                   => 'Boolean',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
