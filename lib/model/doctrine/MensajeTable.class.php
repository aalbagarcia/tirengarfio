<?php


class MensajeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Mensaje');
    }
    
    public static function getMensajesUsuario($id)
    {

        $q = Doctrine_Query::create()
                ->from('Mensaje m')
                ->where('m.receptor = ?', $id)
                ->execute();

        return $q;

    }
    
}