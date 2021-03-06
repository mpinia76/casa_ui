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
 * Filtro para buscar movimientos de Cuenta
 *
 * @author Bernardo
 * @since 05-06-2014
 */
class MovimientoCuentaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCuentaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", CasaUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_saldo",  $this->localize( "cuenta.saldo" ) );


	}

}
?>
