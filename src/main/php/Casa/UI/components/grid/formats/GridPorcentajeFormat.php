<?php
namespace Casa\UI\components\grid\formats;

use Casa\UI\utils\CasaUIUtils;

use Casa\Core\model\Sucursal;
use Casa\Core\model\Producto;
use Rasty\i18n\Locale;
use Rasty\Grid\entitygrid\model\GridValueFormat;

/**
 * Formato para porcentaje
 *
 * @author Bernardo
 * @since 10-06-2014
 *
 */

class GridPorcentajeFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  CasaUIUtils::formatPorcentajeToView($value);
		else $value;
	}


}
