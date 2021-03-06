<?php
namespace Casa\UI\pages\informes\debitosCreditos\modificar;

use Casa\UI\pages\CasaPage;

use Casa\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Casa\Core\model\InformeDiarioDebitoCredito;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeDiarioDebitoCreditoModificar extends CasaPage{

	/**
	 * informeDiarioDebitoCredito a modificar.
	 * @var InformeDiarioDebitoCredito
	 */
	private $informeDiarioDebitoCredito;


	public function __construct(){

		//inicializamos el informeDiarioDebitoCredito.
		$informeDiarioDebitoCredito = new InformeDiarioDebitoCredito();
		$this->setInformeDiarioDebitoCredito($informeDiarioDebitoCredito);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setInformeDiarioDebitoCreditoOid($oid){

		//a partir del id buscamos el informeDiarioDebitoCredito a modificar.
		$informeDiarioDebitoCredito = UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->get($oid);

		$this->setInformeDiarioDebitoCredito($informeDiarioDebitoCredito);

	}

	public function getTitle(){
		return $this->localize( "informeDiarioDebitoCredito.modificar.title" );
	}

	public function getType(){

		return "InformeDiarioDebitoCreditoModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getInformeDiarioDebitoCredito(){

	    return $this->informeDiarioDebitoCredito;
	}

	public function setInformeDiarioDebitoCredito($informeDiarioDebitoCredito)
	{
	    $this->informeDiarioDebitoCredito = $informeDiarioDebitoCredito;
	}
}
?>
