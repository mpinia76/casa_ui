<?php
namespace Casa\UI\components\filter\model;


use Casa\UI\components\filter\model\UICasaCriteria;

use Rasty\utils\RastyUtils;
use Casa\Core\criteria\InformeSemanalCriteria;

/**
 * Representa un criterio de búsqueda
 * para informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class UIInformeSemanalCriteria extends UICasaCriteria{

	private $mes;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new InformeSemanalCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setMes( $this->getMes() );

		return $criteria;
	}



	public function getMes()
	{
	    return $this->mes;
	}

	public function setMes($mes)
	{
	    $this->mes = $mes;
	}
}
