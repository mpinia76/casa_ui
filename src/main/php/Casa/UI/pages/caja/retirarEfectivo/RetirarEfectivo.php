<?php
namespace Casa\UI\pages\caja\retirarEfectivo;

use Casa\UI\service\UICajaService;

use Casa\UI\pages\CasaPage;

use Casa\UI\service\UIServiceFactory;

use Casa\UI\utils\CasaUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Casa\Core\model\Caja;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class RetirarEfectivo extends CasaPage{

	private $caja;

	private $monto;
	private $observaciones;

	private $error;

	public function __construct(){


		$this->caja = UIServiceFactory::getUICajaService()->get( CasaUIUtils::getCaja()->getOid() );

	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("legend",  $this->localize( "caja.retirarEfectivo.legend" ) );

		$xtpl->assign("lbl_montoRetirar",  $this->localize( "retirarEfectivo.montoRetirar" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "retirarEfectivo.observaciones" ) );

		$xtpl->assign("caja_legend",  $this->localize( "caja.retirarEfectivo.caja_legend" ) );

		$xtpl->assign("lbl_submit",  $this->localize( "form.aceptar" ) );
		$xtpl->assign("lbl_cancel",  $this->localize( "form.cancelar" ) );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);


		$caja = $this->getCaja();

		if( !empty($caja) ){

			$xtpl->assign("action", $this->getLinkActionRetirarEfectivo() );
			$xtpl->assign("cancel",  $this->getLinkCajaHome() );

		}else{
		}

		$msg = $this->getError();

		if( !empty($msg) ){

			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}
	}

	public function getTitle(){
		return $this->localize("caja.retirarEfectivo.title") ;
	}

	public function getType(){

		return "RetirarEfectivo";

	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
	}

	public function getMonto()
	{
	    return $this->monto;
	}

	public function setMonto($monto)
	{
	    $this->monto = $monto;
	}

	public function getObservaciones()
	{
	    return $this->observaciones;
	}

	public function setObservaciones($observaciones)
	{
	    $this->observaciones = $observaciones;
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
