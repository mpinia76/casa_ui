<?php
namespace Casa\UI\actions\caja;

use Casa\UI\utils\CasaUIUtils;
use Casa\Core\utils\CasaUtils;

use Casa\UI\service\UIServiceFactory;

use Casa\Core\model\Caja;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;
use Rasty\exception\RastyDuplicatedException;
use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

/**
 * se abre una caja
 *
 * @author Marcos
 * @since 02/08/2018
 */
class AbrirCaja extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("AbrirCaja");

		$cajaForm = $page->getComponentById("cajaForm");

		try {

			//creamos una caja.
			$caja = new Caja();

			//completados con los datos del formulario.
			$cajaForm->fillEntity($caja);

			$user = RastySecurityContext::getUser();
			$user = CasaUtils::getUserByUsername($user->getUsername());

			//agregamos la caja.
			UIServiceFactory::getUICajaService()->abrirCaja( $caja, $user );

			//seteamos la caja para operar en la sesión.
			CasaUIUtils::setCaja($caja);

			$forward->setPageName( $cajaForm->getBackToOnSuccess() );

			$cajaForm->cleanSavedProperties();

		} catch (RastyDuplicatedException $e) {

			$forward->setPageName( "AbrirCaja" );
			$forward->addError( $e->getMessage() );

			//guardamos lo ingresado en el form.
			$cajaForm->save();

		} catch (RastyException $e) {

			$forward->setPageName( "AbrirCaja" );
			$forward->addError(Locale::localize($e->getMessage()) );

			//guardamos lo ingresado en el form.
			$cajaForm->save();

		}

		return $forward;

	}

}
?>
