<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    rs
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'fullname'  => new sfWidgetFormInputText(),
      'email'     => new sfWidgetFormInputText(),
      'sexo'      => new sfWidgetFormInputCheckbox(),
      'fecha_nac' => new sfWidgetFormDate(),
      'provincia' => new sfWidgetFormInputText(),
      'localidad' => new sfWidgetFormInputText(),
      'avatar'    => new sfWidgetFormInputText(),
      'validate'  => new sfWidgetFormInputText(),
      'slug'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'fullname'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sexo'      => new sfValidatorBoolean(array('required' => false)),
      'fecha_nac' => new sfValidatorDate(array('required' => false)),
      'provincia' => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'localidad' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'avatar'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'validate'  => new sfValidatorString(array('max_length' => 17, 'required' => false)),
      'slug'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'sfGuardUserProfile', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
