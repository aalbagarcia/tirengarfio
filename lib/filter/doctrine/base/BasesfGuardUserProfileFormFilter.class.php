<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    rs
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'fullname'  => new sfWidgetFormFilterInput(),
      'email'     => new sfWidgetFormFilterInput(),
      'sexo'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_nac' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'provincia' => new sfWidgetFormFilterInput(),
      'localidad' => new sfWidgetFormFilterInput(),
      'avatar'    => new sfWidgetFormFilterInput(),
      'validate'  => new sfWidgetFormFilterInput(),
      'slug'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'fullname'  => new sfValidatorPass(array('required' => false)),
      'email'     => new sfValidatorPass(array('required' => false)),
      'sexo'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_nac' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'provincia' => new sfValidatorPass(array('required' => false)),
      'localidad' => new sfValidatorPass(array('required' => false)),
      'avatar'    => new sfValidatorPass(array('required' => false)),
      'validate'  => new sfValidatorPass(array('required' => false)),
      'slug'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'user_id'   => 'ForeignKey',
      'fullname'  => 'Text',
      'email'     => 'Text',
      'sexo'      => 'Boolean',
      'fecha_nac' => 'Date',
      'provincia' => 'Text',
      'localidad' => 'Text',
      'avatar'    => 'Text',
      'validate'  => 'Text',
      'slug'      => 'Text',
    );
  }
}
