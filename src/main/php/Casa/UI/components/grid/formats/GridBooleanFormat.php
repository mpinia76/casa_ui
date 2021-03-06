<?php
namespace Casa\UI\components\grid\formats;

use Casa\UI\utils\CasaUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Casa\Core\model\Sucursal;
use Casa\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para boolean
 *
 * @author Bernardo
 * @since 01-12-2014
 *
 */

class GridBooleanFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value )
			return  "si";
		else $value;
	}


}
