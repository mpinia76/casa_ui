<?php
namespace Casa\UI\components\filter\model;


use Casa\UI\components\filter\model\UICasaCriteria;
use Casa\Core\utils\CasaUtils;

use Rasty\utils\RastyUtils;
use Casa\Core\criteria\GastoCriteria;

use Casa\Core\model\EstadoGasto;



/**
 * Representa un criterio de búsqueda
 * para gastos.
 *
 * @author Bernardo
 * @since 28/05/2014
 *
 */
class UIGastoCriteria extends UICasaCriteria{

	/* constantes para los filtros predefinidos */
	const HOY = "gastosHoy";
	const SEMANA_ACTUAL = "gastosSemanaActual";
	const MES_ACTUAL = "gastosMesActual";
	const ANIO_ACTUAL = "gastosAnioActual";
	const IMPAGOS = "gastosImpagos";
	const POR_VENCER = "gastosPorVencer";

	private $fechaDesde;

	private $fechaHasta;

	private $fechaVencimientoHasta;

	private $estadoNotEqual;

	private $estado;

	private $concepto;

	private $observaciones;

	private $estadosIn;

	private $estadosNotIn;


	public function __construct(){

		parent::__construct();

		$this->setFiltroPredefinido( self::POR_VENCER );

	}

	protected function newCoreCriteria(){
		return new GastoCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setFechaVencimientoHasta( $this->getFechaVencimientoHasta() );
		$criteria->setEstadoNotEqual( $this->getEstadoNotEqual() );
		$criteria->setEstado( $this->getEstado() );
		$criteria->setConcepto( $this->getConcepto() );
		$criteria->setObservaciones( $this->getObservaciones() );
		$criteria->setEstadosIn( $this->getEstadosIn() );
		$criteria->setEstadosNotIn( $this->getEstadosNotIn() );

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

	public function getFechaVencimientoHasta()
	{
	    return $this->fechaVencimientoHasta;
	}

	public function setFechaVencimientoHasta($fechaVencimientoHasta)
	{
	    $this->fechaVencimientoHasta = $fechaVencimientoHasta;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}



	public function gastosHoy(){

		$this->setFecha( new \Datetime() );

	}


	public function gastosSemanaActual(){

		$fechaDesde = CasaUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfWeek( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function gastosMesActual(){

		$fechaDesde = CasaUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfMonth( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );

	}

	public function gastosAnioActual(){

		$fechaDesde = CasaUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = CasaUtils::getLastDayOfYear( new \Datetime());

		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}

	public function gastosImpagos(){

		$this->setEstado( EstadoGasto::Impago );

	}

	public function gastosPorVencer(){

		$fechaVencimientoHasta = new \Datetime();
		$fechaVencimientoHasta->modify("+30 day");

		$this->setFechaVencimientoHasta($fechaVencimientoHasta);
		$this->setEstadosNotIn( array( EstadoGasto::Pagado, EstadoGasto::Anulado ) );
		$this->addOrder("fechaVencimiento", "ASC");


	}


	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}

	public function getConcepto()
	{
	    return $this->concepto;
	}

	public function setConcepto($concepto)
	{
	    $this->concepto = $concepto;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
	}

	public function getEstadosIn()
	{
	    return $this->estadosIn;
	}

	public function setEstadosIn($estadosIn)
	{
	    $this->estadosIn = $estadosIn;
	}

	public function getEstadosNotIn()
	{
	    return $this->estadosNotIn;
	}

	public function setEstadosNotIn($estadosNotIn)
	{
	    $this->estadosNotIn = $estadosNotIn;
	}
}
