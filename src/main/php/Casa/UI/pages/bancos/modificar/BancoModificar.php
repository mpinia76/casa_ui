<?php
namespace Casa\UI\pages\bancos\modificar;

use Casa\UI\pages\CasaPage;

use Casa\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Casa\Core\model\Banco;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class BancoModificar extends CasaPage{

	/**
	 * banco a modificar.
	 * @var Banco
	 */
	private $banco;


	public function __construct(){

		//inicializamos el banco.
		$banco = new Banco();
		$this->setBanco($banco);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setBancoOid($oid){

		//a partir del id buscamos el banco a modificar.
		$banco = UIServiceFactory::getUIBancoService()->get($oid);

		$this->setBanco($banco);

	}

	public function getTitle(){
		return $this->localize( "banco.modificar.title" );
	}

	public function getType(){

		return "BancoModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getBanco(){

	    return $this->banco;
	}

	public function setBanco($banco)
	{
	    $this->banco = $banco;
	}
}
?>
