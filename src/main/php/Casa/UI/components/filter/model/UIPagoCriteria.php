<?php
namespace Casa\UI\components\filter\model;


use Casa\UI\utils\CasaUIUtils;
use Casa\Core\utils\CasaUtils;
use Casa\Core\model\EstadoPago;

use Casa\UI\components\filter\model\UICasaCriteria;

use Rasty\utils\RastyUtils;
use Casa\Core\criteria\PagoCriteria;

/**
 * Representa un criterio de búsqueda
 * para Pagos.
 *
 * @author Bernardo
 * @since 13-06-2014
 *
 */
class UIPagoCriteria extends UICasaCriteria{

	/* constantes para los filtros predefinidos */
	const HOY = "pagosHoy";
	const SEMANA_ACTUAL = "pagosSemanaActual";
	const MES_ACTUAL = "pagosMesActual";
	const ANIO_ACTUAL = "pagosAnioActual";
	const IMPAGAS = "pagosImpagos";
	const ANULADAS = "pagosAnulados";

	private $fechaDesde;

	private $fechaHasta;

	private $fecha;

	private $estados;

	private $estadoNotEqual;

	private $estado;

	public function __construct(){

		parent::__construct();

		$this->setFiltroPredefinido( self::HOY );

	}

	protected function newCoreCriteria(){
		return new PagoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setFecha( $this->getFecha() );
		$criteria->setEstados( $this->getEstados() );
		$criteria->setEstado( $this->getEstado() );


		return $criteria;
	}



	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getEstados()
	{
	    return $this->estados;
	}

	public function setEstados($estados)
	{
	    $this->estados = $estados;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}


	public function pagosHoy(){

		$this->setFecha( new \Datetime() );

	}


	public function pagosSemanaActual(){

		$fechaDesde = CasaUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfWeek( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function pagosMesActual(){

		$fechaDesde = CasaUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfMonth( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );

	}

	public function pagosAnioActual(){

		$fechaDesde = CasaUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfYear( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function pagosImpagos(){

		$this->setEstados( array(EstadoPago::Pendiente) );

	}

	public function pagosAnulados(){

		$this->setEstado( EstadoPago::Anulado );
	}

}
