<?php

namespace Casa\UI\components\boxes\caja;

use Casa\UI\service\UIVentaService;

use Casa\UI\utils\CasaUIUtils;

use Casa\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Casa\Core\model\Caja;

use Rasty\utils\LinkBuilder;

/**
 * Caja.
 *
 * @author Bernardo
 * @since 11-06-2014
 */
class CajaBox extends RastyComponent{

	private $caja;
	private $detalle;

	public function getType(){

		return "CajaBox";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_saldo",  $this->localize( "caja.saldo" ) );
		$xtpl->assign("lbl_sucursal",  $this->localize( "caja.sucursal" ) );
		$xtpl->assign("lbl_cajero",  $this->localize( "caja.cajero" ) );
		$xtpl->assign("lbl_saldoInicial",  $this->localize( "caja.saldoInicial" ) );
		//$xtpl->assign("lbl_recaudacion",  $this->localize( "caja.recaudacion" ) );
		$xtpl->assign("lbl_ventas",  $this->localize( "caja.ventas" ) );
		$xtpl->assign("lbl_pagos",  $this->localize( "caja.pagos" ) );
		$xtpl->assign("lbl_gastos",  $this->localize( "caja.gastos" ) );
		$xtpl->assign("lbl_horaApertura",  $this->localize( "caja.horaApertura" ) );
		$xtpl->assign("lbl_fecha",  $this->localize( "caja.fecha" ) );
		$xtpl->assign("lbl_ventas_online_ctacte",  $this->localize( "caja.ventas.online.ctacte" ) );

		$xtpl->assign("legend_detalle_ventas",  $this->localize( "caja.detalle_ventas.legend" ) );

		$xtpl->assign("legend_totales_ventas_dia",  $this->localize( "caja.totales_ventas_dia.legend" ) );
		$xtpl->assign("legend_totales_dia",  $this->localize( "caja.totales_dia.legend" ) );


	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);

		$caja = $this->getCaja();

		if( !empty($caja )){
			$xtpl->assign("sucursal",  $caja->getSucursal() );
			$xtpl->assign("cajero",  $caja->getCajero() );
			$xtpl->assign("saldo",  CasaUIUtils::formatMontoToView($caja->getSaldo()) );
			$xtpl->assign("saldoInicial",  CasaUIUtils::formatMontoToView($caja->getSaldoInicial()) );
			$xtpl->assign("recaudacion",  CasaUIUtils::formatMontoToView($caja->getRecaudacion()) );
			$xtpl->assign("horaApertura",  CasaUIUtils::formatTimeToView($caja->getHoraApertura()) );
			$xtpl->assign("fecha",  CasaUIUtils::formatDateToView($caja->getFecha()) );

			$ventas_online_ctacte = UIServiceFactory::getUIVentaService()->getTotalesCajaVentasOnlineCtaCte($caja);
			$xtpl->assign("ventas_online_ctacte",  CasaUIUtils::formatMontoToView( $ventas_online_ctacte ) );

			if( $this->getDetalle() ){

				//detalles de la caja.
				$gastos = UIServiceFactory::getUIGastoService()->getTotalesCuenta($caja);
				$xtpl->assign("gastos",  CasaUIUtils::formatMontoToView($gastos) );

				$pagos = UIServiceFactory::getUIPagoPremioService()->getTotalesCuenta($caja);
				$xtpl->assign("pagos",  CasaUIUtils::formatMontoToView($pagos) );

				$ventas = UIServiceFactory::getUIVentaService()->getTotalesCuenta($caja);
				$xtpl->assign("ventas",  CasaUIUtils::formatMontoToView($ventas) );

				$xtpl->parse("main.detalles");


				$fecha = new \DateTime();
				$totales = UIServiceFactory::getUIVentaService()->getTotalesCuentaPorCategoria($caja);
				foreach ($totales as $total) {
					$importe = $total["monto"];
					$nombreCategoria = $total["categoria"];
					$xtpl->assign("lbl_categoria",  $nombreCategoria );
					$xtpl->assign("importe",  CasaUIUtils::formatMontoToView($importe) );
					$xtpl->parse("main.ventas.detalle_categoria");
				}
				$xtpl->parse("main.ventas");


				$this->parseDetallesDelDia( $xtpl );

			}

		}

	}

	private function parseDetallesDelDia( XTemplate $xtpl ){

		//obtenemos las cajas del día.
		$cajas = UIServiceFactory::getUICajaService()->getCajasFecha( new \DateTime() );

		$gastos = 0;
		$pagos = 0;
		$ventas = 0;
		foreach ($cajas as $caja) {
			$gastos += UIServiceFactory::getUIGastoService()->getTotalesCuenta( $caja );
			$pagos += UIServiceFactory::getUIPagoPremioService()->getTotalesCuenta( $caja );
			$ventas += UIServiceFactory::getUIVentaService()->getTotalesCuenta( $caja );
		}

		$xtpl->assign("gastos",  CasaUIUtils::formatMontoToView($gastos) );
		$xtpl->assign("pagos",  CasaUIUtils::formatMontoToView($pagos) );
		$xtpl->assign("ventas",  CasaUIUtils::formatMontoToView($ventas) );

		$xtpl->parse("main.totales_dia");

		$fecha = new \DateTime();
		$totales = UIServiceFactory::getUIVentaService()->getTotalesCuentaPorCategoria(null, $fecha);
		foreach ($totales as $total) {
			$importe = $total["monto"];
			$nombreCategoria = $total["categoria"];
			$xtpl->assign("lbl_categoria",  $nombreCategoria );
			$xtpl->assign("importe",  CasaUIUtils::formatMontoToView($importe) );
			$xtpl->parse("main.ventas_dia.detalle_categoria");
		}
		$xtpl->parse("main.ventas_dia");
	}

	protected function initObserverEventType(){
		$this->addEventType( "Caja" );
	}

	public function setCajaOid($oid){
		if( !empty($oid) ){
			$caja = UIServiceFactory::getUICajaService()->get($oid);
			$this->setCaja($caja);
		}
	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
	}

	public function getDetalle()
	{
	    return $this->detalle;
	}

	public function setDetalle($detalle)
	{
	    $this->detalle = $detalle;
	}
}
?>
