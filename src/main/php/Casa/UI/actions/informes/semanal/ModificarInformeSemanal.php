<?php
namespace Casa\UI\actions\informes\semanal;

use Casa\UI\components\form\informeSemanal\InformeSemanalForm;

use Casa\UI\service\UIServiceFactory;
use Casa\UI\utils\CasaUIUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Casa\Core\utils\CasaUtils;
use Cose\Security\model\User;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de un InformeSemanal.
 *
 * @author Bernardo
 * @since 14/04/2015
 */
class ModificarInformeSemanal extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("InformeSemanalModificar");

		$informeSemanalForm = $page->getComponentById("informeSemanalForm");

		$oid = $informeSemanalForm->getOid();

		try {

			//obtenemos el informeSemanal.
			$informeSemanal = UIServiceFactory::getUIInformeSemanalService()->get($oid );

			//lo editamos con los datos del formulario.
			$informeSemanalForm->fillEntity($informeSemanal);

			$user = RastySecurityContext::getUser();
			$user = CasaUtils::getUserByUsername($user->getUsername());

			$informeSemanal->setUser( $user );

			//guardamos los cambios.
			UIServiceFactory::getUIInformeSemanalService()->update( $informeSemanal );

			$forward->setPageName( $informeSemanalForm->getBackToOnSuccess() );
			$forward->addParam( "informeSemanalOid", $informeSemanal->getOid() );

			$informeSemanalForm->cleanSavedProperties();

		} catch (RastyException $e) {

			$forward->setPageName( "InformeSemanalModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );

			//guardamos lo ingresado en el form.
			$informeSemanalForm->save();

		}
		return $forward;

	}

}
?>
