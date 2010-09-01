<?php

/**
 * Usuario form.
 *
 * @package    rs
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  /**
   * @see sfGuardUserForm
   */
  public function configure()
  {

            parent::configure();

        $years = range(date('Y'),1900);

//        $this->getObject()->getAvatar() == 'avatar_generico.jpg' ?
//        var_dump("generico") : var_dump("no_generico");


                $this->setWidgets(array(
                'fullname' => new sfWidgetFormInputText(),
                'email' => new sfWidgetFormInputText(),
                'fecha_nac' => new sfWidgetFormI18nDate(array('culture' => 'es_ES', 'years' => array_combine($years, $years))),
                'localidad' => new sfWidgetFormInputText(),
                'provincia' => new sfWidgetFormInputText(),
                    'avatar' => new myWidgetFormInputFileEditable(array(
                                                                       'file_src' => '/uploads/fotografias_miembros/'.$this->getObject()->getAvatar(),
                                                                       'is_image' => true,        // El archivo es una imagen y se debe visualizar.
                                                                       'with_delete' => false,    // Añadimos un checkbox para borrar la imagen.
                                                                                                   'eliminar_archivo' => $this->getObject()->getAvatar() != 'avatar_generico.jpg'
                                                                           )),
                    'sexo' => new sfWidgetFormChoice(array('expanded' => true,
                                                                                           'multiple' => false,
                                                                                   'choices' => array( 1  => 'Chico',
                                                                                                       0  => 'Chica'))),
            ));


                $this->useFields(array('fullname', 'email', 'fecha_nac',
                               'sexo', 'localidad', 'provincia', 'avatar'));


            $decorator = new myWidgetFormSchemaFormatterTable1($this->getWidgetSchema());
            $this->widgetSchema->addFormFormatter('tablas.mio', $decorator);
            $this->widgetSchema->setFormFormatterName('tablas.mio');


                $this->setValidators(array(
                                                              'fullname' => new sfValidatorString(
                                                                                        array(),
                                                                                        array('required' => 'Your name is required.')),
                                                              'email' => new sfValidatorEmail(array('trim' => true),
                                                                                        array('required' => 'Your e-mail address is required.',
                                                                                              'invalid' => 'The email address is invalid.')),
                                                              'fecha_nac' => new sfValidatorDate (
                                                                                        array('max' => (date('Y')-14).'-'.date('m').'-'.date('d'),
                                                                                              'required' => 'Your born date is required.'),
                                                                                        array('max' => 'You must be older than 14 years old')),
                                                              'sexo' => new sfValidatorChoice(
                                                                                        array('choices' => array(0,1))),
                                                              'localidad' => new sfValidatorString(
                                                                                        array(),
                                                                                        array('required' => 'Your town is required.')),
                                                              'provincia' => new sfValidatorString(
                                                                                        array(),
                                                                                        array('required' => 'Your province is required.')),
                                                              'avatar' => new sfValidatorFile(
                                                                                        array('required' => false,
                                                                                                      // Comprueba que la foto se va a guardar en este path.
                                                                                                      'validated_file_class' => 'myValidatedResizedFile',
                                                                                                                  'path' => sfConfig::get('sf_upload_dir').'/fotografias_miembros',
                                                                                                                  'mime_types' => 'web_images' ))
            ));



        $this->widgetSchema->setLabel('fullname', 'Nombre y apellidos');

        $this->widgetSchema->setLabel('fecha_nac', 'Fecha de nacimiento');

        $this->widgetSchema->setLabel('email', 'E-mail');

        $this->widgetSchema->setNameFormat('usuario[%s]');

  }


  protected function processUploadedFile($field, $filename = null, $values = null)
  {
    if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
    {
      throw new LogicException(sprintf('You cannot save the current file for field "%s" as the field is not a file.', $field));
    }

    if (null === $values)
    {
      $values = $this->values;
    }

    if (isset($values[$field.'_delete']) && $values[$field.'_delete'])
    {
      $this->removeFile($field);

      return '';
    }

    if (!$values[$field])
    {
      // this is needed if the form is embedded, in which case
      // the parent form has already changed the value of the field
      $oldValues = $this->getObject()->getModified(true, false);

      return isset($oldValues[$field]) ? $oldValues[$field] : $this->object->$field;
    }

    // we need the base directory
    if (!$this->validatorSchema[$field]->getOption('path'))
    {
      return $values[$field];
    }



    if ($this->getWidget('avatar')->getOption('eliminar_archivo')){

        $this->removeFile($field);
    }

    return $this->saveFile($field, $filename, $values[$field]);
  }





}
