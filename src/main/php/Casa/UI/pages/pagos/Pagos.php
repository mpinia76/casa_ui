<?php
namespace Casa\UI\pages\pagos;

use Casa\UI\pages\CasaPage;

use Casa\UI\components\filter\model\UIPagoCriteria;

use Casa\UI\components\grid\model\PagoGridModel;

use Casa\UI\service\UIPagoService;

use Casa\UI\utils\CasaUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Casa\Core\model\Pago;
use Casa\Core\criteria\PagoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los pagos.
 *
 * @author Bernardo
 * @since 13-06-2014
 *
 */
class Pagos extends CasaPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "pagos.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();


		return array($menuGroup);
	}

	public function getType(){

		return "Pagos";

	}

	public function getModelClazz(){
		return get_class( new PagoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIPagoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

	}

}
?>
