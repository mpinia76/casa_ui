<?php

namespace Casa\UI\components\filter\movimiento;

use Casa\UI\service\UIServiceFactory;

use Casa\UI\utils\CasaUIUtils;

use Casa\UI\components\grid\model\MovimientoCuentaGridModel;

use Casa\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Casa\UI\components\filter\model\UIMovimientoCriteria;

use Casa\UI\components\grid\model\MovimientoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de caja
 *
 * @author Bernardo
 * @since 04-06-2014
 */
class MovimientoCajaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCajaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", CasaUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_numero",  $this->localize("caja.numero") );
		$xtpl->assign("lbl_saldo",  $this->localize( "caja.saldo" ) );
		$xtpl->assign("lbl_sucursal",  $this->localize( "caja.sucursal" ) );
		$xtpl->assign("lbl_cajero",  $this->localize( "caja.cajero" ) );
		$xtpl->assign("lbl_saldoInicial",  $this->localize( "caja.saldoInicial" ) );
		$xtpl->assign("lbl_recaudacion",  $this->localize( "caja.recaudacion" ) );
		$xtpl->assign("lbl_horaApertura",  $this->localize( "caja.horaApertura" ) );

		$caja = $this->getCuenta();
		$xtpl->assign("sucursal",  $caja->getSucursal() );
		$xtpl->assign("numero",  $caja->getNumero() );
		$xtpl->assign("cajero",  $caja->getCajero() );
		$xtpl->assign("saldo",  CasaUIUtils::formatMontoToView($caja->getSaldo()) );
		$xtpl->assign("saldoInicial",  CasaUIUtils::formatMontoToView($caja->getSaldoInicial()) );
		$xtpl->assign("recaudacion",  CasaUIUtils::formatMontoToView($caja->getRecaudacion()) );
		$xtpl->assign("horaApertura",  CasaUIUtils::formatTimeToView($caja->getHoraApertura()) );
	}

}
?>
