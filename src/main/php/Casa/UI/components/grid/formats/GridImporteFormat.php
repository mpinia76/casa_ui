<?php
namespace Casa\UI\components\grid\formats;

use Casa\UI\utils\CasaUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Casa\Core\model\Sucursal;
use Casa\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para imprte
 *
 * @author Bernardo
 * @since 04-06-2014
 *
 */

class GridImporteFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  CasaUIUtils::formatMontoToView($value);
		else $value;
	}


}
