<?php

/**
 * sfGuardUserProfile
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    rs
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUserProfile extends BasesfGuardUserProfile
{
	
	
	public function getEdad()
	{

    $fecha_nac = $this->getFechaNac();

		list($anio,$mes,$dia) = explode("-",$fecha_nac);
		$anio_dif = date("Y") - $anio;
		$mes_dif = date("m") - $mes;
		$dia_dif = date("d") - $dia;
		if ($dia_dif < 0 || $mes_dif < 0)
		$anio_dif--;
		return $anio_dif;
    }
	
}
