<?php
namespace Casa\UI\pages\bancos;

use Casa\UI\service\UIServiceFactory;

use Casa\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Casa\UI\components\grid\model\MovimientoCuentaGridModel;

use Casa\UI\pages\CasaPage;

use Casa\UI\utils\CasaUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de banco.
 *
 * @author Bernardo
 * @since 09-06-2014
 *
 */
class MovimientosBanco extends CasaPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "banco.movimientos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "cliente.agregar") );
//		$menuOption->setPageName("ClienteAgregar");
//		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
//		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "MovimientosBanco";

	}

	public function getModelClazz(){
		return get_class( new MovimientoCuentaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCuentaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

//	public function getBanco(){
//
//		//lo fijamos en la cuenta BAPRO.
//		return UIServiceFactory::getUICuentaService()->getCuentaBAPRO();
//	}
}
?>
