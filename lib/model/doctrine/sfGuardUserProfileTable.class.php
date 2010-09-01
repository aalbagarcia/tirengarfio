<?php


class sfGuardUserProfileTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardUserProfile');
    }
    
    public static function getAmigos($id) {

 		$q1 = Doctrine_Query::create()
			        ->from('sfGuardUserProfile u')
			        ->leftJoin('u.AmigoUsuario a ON u.id = a.user2_id OR u.id = a.user1_id')
			        ->where("a.user2_id = ? OR a.user1_id = ?", array($id,$id))
			        // de esta manera no extraemos el usuario de la sesión.
			        ->andWhere("u.id <> ?", $id)
			        // de esta manera NO extremos a los de la "solicitud de amistad pendiente de aceptación" (estado = 0).
			        ->andWhere("a.estado LIKE ?", 1);
			        
		return $q1;

	}

	
	public static function getMiembrosSolicitudAmistadEnviada($id) {

		$q1 = Doctrine_Query::create()
		->from('sfGuardUser u')
		->leftJoin('u.AmigoUsuario a ON u.id = a.user2_id')
		->where("a.user1_id = ?", $id)
		->andWhere("a.estado LIKE ?", 0);

		return $q1;

	}

	public static function getIdMiembros($miembros) {

		$amigos_id = array();

		foreach ($miembros as $m) {
			$amigos_id[] = $m->getId();
		}


		return $amigos_id;

	}
    
}