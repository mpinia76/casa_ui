<?php
namespace Casa\UI\pages\informes\semanal;

use Casa\UI\pages\CasaPage;

use Casa\UI\components\filter\model\UIInformeSemanalCriteria;

use Casa\UI\components\grid\model\InformeSemanalGridModel;

use Casa\UI\service\UIInformeSemanalService;

use Casa\UI\utils\CasaUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Casa\Core\model\InformeSemanal;
use Casa\Core\criteria\InformeSemanalCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class InformesSemanales extends CasaPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "informesSemanales.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.informesSemanales.agregar") );
		$menuOption->setPageName("InformeSemanalAgregar");
		$menuOption->setIconClass( "icon-agregar fg-green" );
		$menuGroup->addMenuOption( $menuOption );


//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "menu.informesSemanales.reportes") );
//		$menuOption->setPageName( "InformeSemanalStats" );
//		$menuOption->setIconClass( "icon-stats" );
//		$menuGroup->addMenuOption( $menuOption );
//
//
		return array($menuGroup);
	}

	public function getType(){

		return "InformesSemanales";

	}

	public function getModelClazz(){
		return get_class( new InformeSemanalGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIInformeSemanalCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("informeSemanal.agregar") );
	}

}
?>
