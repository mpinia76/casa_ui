<?php
namespace Casa\UI\pages\informes\debitosCreditos;

use Casa\UI\pages\CasaPage;

use Casa\UI\components\filter\model\UIInformeDiarioDebitoCreditoCriteria;

use Casa\UI\components\grid\model\InformeDiarioDebitoCreditoGridModel;

use Casa\UI\service\UIInformeDiarioDebitoCreditoService;

use Casa\UI\utils\CasaUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Casa\Core\model\InformeDiarioDebitoCredito;
use Casa\Core\criteria\InformeDiarioDebitoCreditoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class InformesDiariosDebitoCredito extends CasaPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "informesDiariosDebitoCredito.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.informesDiariosDebitoCredito.agregar") );
		$menuOption->setPageName("InformeDiarioDebitoCreditoAgregar");
		$menuOption->setIconClass( "icon-agregar fg-green" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "InformesDiariosDebitoCredito";

	}

	public function getModelClazz(){
		return get_class( new InformeDiarioDebitoCreditoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIInformeDiarioDebitoCreditoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("informeDiarioDebitoCredito.agregar") );
	}

}
?>
