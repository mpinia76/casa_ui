<?php
namespace Casa\UI\pages\gastos\anular;

use Casa\UI\service\UIServiceFactory;

use Casa\Core\utils\CasaUtils;
use Casa\UI\utils\CasaUIUtils;

use Casa\UI\pages\CasaPage;

use Rasty\utils\XTemplate;
use Casa\Core\model\Gasto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class GastoAnular extends CasaPage{

	/**
	 * gasto a anular.
	 * @var Gasto
	 */
	private $gasto;

	private $error;

	public function __construct(){

		//inicializamos el gasto.
		$gasto = new Gasto();


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
		return $this->localize( "gasto.anular.title" );
	}

	public function getType(){

		return "GastoAnular";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign( "gasto_legend", $this->localize( "anularGasto.gasto.legend") );

		$xtpl->assign( "gastoOid", $this->getGasto()->getOid() );

		$xtpl->assign( "linkAnularGasto", $this->getLinkActionAnularGasto($this->getGasto()) );

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}

		$xtpl->assign( "lbl_submit", $this->localize("anularGasto.confirm") );
		$xtpl->assign( "lbl_cancel", $this->localize("anularGasto.cancel") );

	}


	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}

	public function setGastoOid($gastoOid)
	{
		if(!empty($gastoOid)){
			$gasto = UIServiceFactory::getUIGastoService()->get($gastoOid);
			$this->setGasto($gasto);
		}


	}

	public function getMsgError(){
		return "";
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>
