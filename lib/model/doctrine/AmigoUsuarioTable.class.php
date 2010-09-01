<?php


class AmigoUsuarioTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AmigoUsuario');
    }
    
    
    public static function getSolicitudesAmistadRecibidas($id)
    {

        $q = Doctrine_Query::create()
                ->from('AmigoUsuario m')
                ->where('m.user2_id = ?', $id)
                ->andWhere('m.estado = ?', 0)
                ->execute();

        return $q;

    }
}