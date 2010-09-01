<?php

/**
 * Mensaje form.
 *
 * @package    rs
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MensajeForm extends BaseMensajeForm
{
  public function configure()
  {

       $this->useFields(array('sf_guard_user_profile_id','receptor','tipo','titulo','contenido', 'estado'));

           $this->setWidgets(array('sf_guard_user_profile_id' => new sfWidgetFormInputHidden(),
                                   'receptor'   => new sfWidgetFormInputHidden(),
                                   'tipo'       => new sfWidgetFormInputHidden,
                                   'titulo'     => new sfWidgetFormInputText(),
                                   'contenido'  => new sfWidgetFormTextarea(),
                                   'estado'     => new sfWidgetFormInputHidden,

           ));


           $decorator = new myWidgetFormSchemaFormatterTable2($this->getWidgetSchema());
           $this->widgetSchema->addFormFormatter('tablas.mio', $decorator);
           $this->widgetSchema->setFormFormatterName('tablas.mio');

           $this->widgetSchema->setLabels(array('titulo' => 'Asunto:',
                                 'contenido' => 'Mensaje:'
           ));

           $this->widgetSchema->setNameFormat('mensaje[%s]');



  }
}