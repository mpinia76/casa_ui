<?php
namespace Casa\UI\conf;


use Rasty\conf\RastyConfig;
use Rasty\app\LoadRasty;
use Rasty\utils\Logger;

use Rasty\Menu\conf\RastyMenuConfig;
use Rasty\Layout\conf\RastyLayoutConfig;
use Rasty\Forms\conf\RastyFormsConfig;
use Rasty\Grid\conf\RastyGridConfig;
use Rasty\Security\conf\RastySecurityConfig;
use Rasty\Crud\conf\RastyCrudConfig;
use Rasty\Catalogo\conf\RastyCatalogoConfig;
use Casa\Core\conf\CasaConfig;



use Rasty\security\RastySecurityContext;
use Rasty\app\SecurityRastyListener;

use Rasty\cache\RastyApcCache;
use Rasty\cache\RastyMockCache;

/**
 * configuración Casa ui
 *
 * @author Bernardo
 * @since 24/05/2014
 */
class CasaUISetup {

	/**
	 * inicializamos la aplicación de casa ui
	 */
	public static function initialize( $appName = "casa_ui"){


		//inicializamos la sesión.
		//session_set_cookie_params(0, $appName );

		if(!isset($_SESSION)){
         session_set_cookie_params(0, $appName);
         @session_regenerate_id(true);
             session_start();
         }

//		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
//			RastySecurityContext::logout();
//		}
//		$_SESSION['LAST_ACTIVITY'] = time();


		//configuramos php
		self::configurePhp();

		//casa core
		self::initializeCore();

		//casa ui
		self::initializeUI( $appName );



	}

	/**
	 * Configuraciones para php
	 */
	private static function configurePhp(){

		//algunos configuraciones para php.
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', '0');
		ini_set('display_errors', '0');
		date_default_timezone_set('America/Argentina/Buenos_Aires');

		include_once dirname(__DIR__) . "/conf/errorHandler.php";
	}

	/**
	 * Inicializamos casa core.
	 */
	private static function initializeCore(){

		CasaConfig::getInstance()->setDbName("cose_casa");

		CasaConfig::getInstance()->initialize();
		CasaConfig::getInstance()->initLogger(dirname(__DIR__) . "/conf/log4php.xml");

	}


	/**
	 * Inicializamos casa ui + Rasty
	 */
	private static function initializeUI( $appName ){

		$appHome = $_SERVER["DOCUMENT_ROOT"];

		//inicializamos rasty indicando el home de la up y el nombre
		RastyConfig::getInstance()->initialize($appHome, $appName);
		//RastyConfig::getInstance()->setWebsocketUrl("192.168.1.34");
		RastyConfig::getInstance()->setCacheId($appName);
		RastyConfig::getInstance()->setCacheType(get_class( new RastyMockCache()));

		//configuramos el logger,
		Logger::configure( dirname(__DIR__) . "/conf/log4php.xml" );
		Logger::log("Logger casa ui configurado!");


		//cargamos los componentes de casa ui.
		$rastyLoader = LoadRasty::getInstance();
		$rastyLoader->loadXml(

				dirname(__DIR__) . '/conf/rasty.xml',
				RastyConfig::getInstance()->getAppPath() . "src/main/php/Casa/UI/",
				RastyConfig::getInstance()->getWebPath()

		);

		//inicializamos los módulos rasty que utilizaremos
		RastyGridConfig::initialize();
		RastyLayoutConfig::initialize();
		RastyFormsConfig::initialize();;
		RastyMenuConfig::initialize();
		RastySecurityConfig::getInstance()->initialize();
		RastyCrudConfig::getInstance()->initialize();
		RastyCatalogoConfig::getInstance()->initialize("RastyCatalogoLayout");
		RastyCatalogoConfig::getInstance()->initialize("RastySecuriryPublicLayout");

		RastyConfig::getInstance()->setCacheType(get_class( new RastyApcCache()));

		//inicializamos los listeners de la apllicaci�n
		RastyConfig::getInstance()->addAppListener( new SecurityRastyListener() );

	}

}
