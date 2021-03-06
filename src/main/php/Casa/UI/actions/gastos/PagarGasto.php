<?php
namespace Casa\UI\actions\gastos;

use Casa\UI\utils\CasaUIUtils;
use Casa\Core\utils\CasaUtils;


use Casa\UI\service\UIServiceFactory;
use Casa\Core\model\Gasto;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Rasty\utils\Logger;


/**
 * se paga un gasto
 *
 * @author Bernardo
 * @since 29/05/2014
 */
class PagarGasto extends Action{


	public function execute(){

		$forward = new Forward();

		//tomamos la gasto y la cuenta con la cuenta se paga
		$gastoOid = RastyUtils::getParamGET("gastoOid");
		$cuentaOid = RastyUtils::getParamGET("cuentaOid");

		$backTo = CasaUIUtils::isAdminLogged()?"AdminHome":"CajaHome";

		$forward->addParam( "gastoOid", $gastoOid );
		try {

			$fechaHora = CasaUIUtils::newDateTime( RastyUtils::getParamGET("fechaHora").' '.date('H:i') );

			//recuperamos el gasto.
			$gasto = UIServiceFactory::getUIGastoService()->get( $gastoOid );

			//recuperamos la cuenta
			$cuenta = UIServiceFactory::getUICuentaService()->get( $cuentaOid );

			$user = RastySecurityContext::getUser();
			$user = CasaUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIGastoService()->pagar($gasto, $cuenta, $user, $fechaHora);

			$forward->setPageName( $backTo );


		} catch (RastyException $e) {

			$forward->setPageName( "GastoPagar" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
