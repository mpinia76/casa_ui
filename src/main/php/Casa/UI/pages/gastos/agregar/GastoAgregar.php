<?php
namespace Casa\UI\pages\gastos\agregar;

use Casa\Core\utils\CasaUtils;
use Casa\UI\utils\CasaUIUtils;

use Casa\UI\pages\CasaPage;

use Rasty\utils\XTemplate;
use Casa\Core\model\Gasto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class GastoAgregar extends CasaPage{

	/**
	 * gasto a agregar.
	 * @var Gasto
	 */
	private $gasto;


	public function __construct(){

		//inicializamos el gasto.
		$gasto = new Gasto();

		$gasto->setFechaHora( new \Datetime() );
		//$gasto->setSucursal( CasaUIUtils::getSucursal() );
		//$gasto->setConcepto( CasaUtils::getConceptoGastoVarios() );

		$this->setGasto($gasto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Gastos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "gasto.agregar.title" );
	}

	public function getType(){

		return "GastoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$gastoForm = $this->getComponentById("gastoForm");
		$gastoForm->fillFromSaved( $this->getGasto() );

	}


	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}



	public function getMsgError(){
		return "";
	}
}
?>
