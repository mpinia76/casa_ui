<?php
namespace Casa\UI\actions\informes\comisiones;


use Casa\UI\components\form\informeDiarioComision\InformeDiarioComisionForm;

use Casa\UI\service\UIServiceFactory;
use Casa\Core\model\InformeDiarioComision;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;

use Casa\Core\utils\CasaUtils;
use Cose\Security\model\User;


/**
 * se realiza el alta de un InformeDiarioComision.
 *
 * @author Bernardo
 * @since 16/04/2015
 */
class AgregarInformeDiarioComision extends Action{


	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("InformeDiarioComisionAgregar");

		$informeDiarioComisionForm = $page->getComponentById("informeDiarioComisionForm");

		try {

			//creamos un nuevo informeDiarioComision.
			$informeDiarioComision = new InformeDiarioComision();

			//completados con los datos del formulario.
			$informeDiarioComisionForm->fillEntity($informeDiarioComision);

			$user = RastySecurityContext::getUser();
			$user = CasaUtils::getUserByUsername($user->getUsername());

			$informeDiarioComision->setUser( $user );

			//agregamos el informeDiarioComision.
			UIServiceFactory::getUIInformeDiarioComisionService()->add( $informeDiarioComision );

			$forward->setPageName( $informeDiarioComisionForm->getBackToOnSuccess() );
			$forward->addParam( "informeDiarioComisionOid", $informeDiarioComision->getOid() );

			$informeDiarioComisionForm->cleanSavedProperties();


		} catch (RastyException $e) {

			$forward->setPageName( "InformeDiarioComisionAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );

			//guardamos lo ingresado en el form.
			$informeDiarioComisionForm->save();
		}

		return $forward;

	}

}
?>
