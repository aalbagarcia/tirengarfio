<?php

/**
 * Usuario filter form.
 *
 * @package    rs
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileFormFilter extends BasesfGuardUserProfileFormFilter
{
  /**
   * @see sfGuardUserFormFilter
   */
        public function configure() {


            $this->widgetSchema['nombre_apellidos'] = new sfWidgetFormFilterInput(array('with_empty' => false));
            $this->widgetSchema['sexo'] = new sfWidgetFormChoice(array('expanded' => true,
            															   'multiple' => false,
                                                                           'choices' => array(0  => 'Chica', 1  => 'Chico', '' => 'Ambos')));
            $this->widgetSchema['localidad'] = new sfWidgetFormFilterInput(array('with_empty' => false));
            $this->widgetSchema['provincia'] = new sfWidgetFormFilterInput(array('with_empty' => false));

            $years = range(14,130);
            $this->widgetSchema['edad'] = new sfWidgetFormSchema();
            foreach (array('de', 'a') as $value)
            {
                        $this->widgetSchema['edad'][$value] = new sfWidgetFormChoice(array(
                                                               'label' => $value,
                                                               'choices' => array('' =>  '-') + array_combine($years,$years)));
             }


            $this->useFields(array('nombre_apellidos', 'sexo', 'edad', 'localidad', 'provincia'));


            $decorator = new myWidgetFormSchemaFormatterList1($this->getWidgetSchema());
            $this->widgetSchema->addFormFormatter('tablas.mio', $decorator);
            $this->widgetSchema->setFormFormatterName('tablas.mio');

            $decorator_edad = new myWidgetFormSchemaFormatterTable4($this->widgetSchema['edad']);
            $this->widgetSchema['edad']->addFormFormatter('tablas.mio2', $decorator_edad);
            $this->widgetSchema['edad']->setFormFormatterName('tablas.mio2');
            $this->widgetSchema['edad'] = new sfWidgetFormSchemaDecorator(
			                                                    $this->widgetSchema['edad'],
            													$this->widgetSchema['edad']->getFormFormatter()->getDecoratorFormat());


            $this->widgetSchema->setLabel('nombre_apellidos', 'Nombre o apellidos');

         }

         
     // sobreescribimos este método para que no aparezca el usuario de la sesión en la lista de miembros.
     // siempre se sobreescribe este método en vez de buildQuery().
     public function doBuildQuery(array $values){
         

          // recuperamos la query que symfony genera por defecto.
          $query = parent::doBuildQuery($values);

          // recuperamos el id del usuario de la sesión (ver executeIndex() en miembros/actions/actions.class.php)
          $user_id = $this->getOption('user_id');

          $query->addWhere('r.id != ?', $user_id);

          return $query;
     }


     public function addNombreApellidosColumnQuery($query, $field, $value)
     {

         $fieldName = $this->getFieldName($field);

         $palabras_busqueda = explode(' ', $value['text']);

         if (!empty($value['text']))
         {
                 foreach($palabras_busqueda as $palabra){

                 $query->andWhere(sprintf('%s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ?',
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName),
                                      array(     $palabra,
                                                 $palabra.' %',
                                            '% '.$palabra,
                                            '% '.$palabra.' %'));

                 }

         }

     }


     public function addProvinciaColumnQuery($query, $field, $value)
     {

         $fieldName = $this->getFieldName($field);

         $palabras_busqueda = explode(' ', $value['text']);

         if (!empty($value['text']))
         {
                 foreach($palabras_busqueda as $palabra){


                 $query->andWhere(sprintf('%s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ?',
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName),
                                      array(     $palabra,
                                                 $palabra.' %',
                                            '% '.$palabra,
                                            '% '.$palabra.' %'));

                 }

         }

     }

     public function addLocalidadColumnQuery($query, $field, $value)
     {

         $fieldName = $this->getFieldName($field);

         $palabras_busqueda = explode(' ', $value['text']);

         if (!empty($value['text']))
         {
         	
                 foreach($palabras_busqueda as $palabra){


                 $query->andWhere(sprintf('%s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ? OR %s.%s LIKE ?',
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName,
                                              $query->getRootAlias(), $fieldName),
                                      array(     $palabra,
                                                 $palabra.' %',
                                            '% '.$palabra,
                                            '% '.$palabra.' %'));

                 }

         }

     }





}
