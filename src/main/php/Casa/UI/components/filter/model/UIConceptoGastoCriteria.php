<?php
namespace Casa\UI\components\filter\model;


use Casa\UI\components\filter\model\UICasaCriteria;

use Rasty\utils\RastyUtils;
use Casa\Core\criteria\ConceptoGastoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Conceptos de gastos.
 *
 * @author Bernardo
 * @since 29/05/2014
 *
 */
class UIConceptoGastoCriteria extends UICasaCriteria{

	private $nombre;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new ConceptoGastoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNombre( $this->getNombre() );

		return $criteria;
	}



	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}
}
