<?php
namespace Casa\UI\pages\bancos\agregar;

use Casa\UI\pages\CasaPage;

use Rasty\utils\XTemplate;
use Casa\Core\model\Banco;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class BancoAgregar extends CasaPage{

	/**
	 * Banco a agregar.
	 * @var Banco
	 */
	private $Banco;


	public function __construct(){

		//inicializamos el Banco.
		$Banco = new Banco();


		$this->setBanco($Banco);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Bancos");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "banco.agregar.title" );
	}

	public function getType(){

		return "BancoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$bancoForm = $this->getComponentById("bancoForm");
		$bancoForm->fillFromSaved( $this->getBanco() );

	}


	public function getBanco()
	{
	    return $this->Banco;
	}

	public function setBanco($Banco)
	{
	    $this->Banco = $Banco;
	}



	public function getMsgError(){
		return "";
	}
}
?>
