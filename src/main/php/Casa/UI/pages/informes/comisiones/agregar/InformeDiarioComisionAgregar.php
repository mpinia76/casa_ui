<?php
namespace Casa\UI\pages\informes\comisiones\agregar;

use Casa\Core\utils\CasaUtils;
use Casa\UI\utils\CasaUIUtils;

use Casa\UI\pages\CasaPage;

use Rasty\utils\XTemplate;
use Casa\Core\model\InformeDiarioComision;
use Casa\Core\model\EstadoInformeDiarioComision;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeDiarioComisionAgregar extends CasaPage{

	/**
	 * informeDiarioComision a agregar.
	 * @var InformeDiarioComision
	 */
	private $informeDiarioComision;


	public function __construct(){

		//inicializamos el informeDiarioComision.
		$informeDiarioComision = new InformeDiarioComision();

		$informeDiarioComision->setSucursal( CasaUIUtils::getSucursal() );
		$informeDiarioComision->setFecha( new \DateTime() );

		$this->setInformeDiarioComision($informeDiarioComision);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("InformeDiarioComisions");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "informeDiarioComision.agregar.title" );
	}

	public function getType(){

		return "InformeDiarioComisionAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){


	}


	public function getInformeDiarioComision()
	{
	    return $this->informeDiarioComision;
	}

	public function setInformeDiarioComision($informeDiarioComision)
	{
	    $this->informeDiarioComision = $informeDiarioComision;
	}



	public function getMsgError(){
		return "";
	}
}
?>
