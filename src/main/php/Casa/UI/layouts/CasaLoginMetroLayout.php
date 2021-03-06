<?php

namespace Casa\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class CasaLoginMetroLayout extends CasaMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/CasaLoginMetroLayout.htm" );
	}

	public function getType(){

		return "CasaLoginMetroLayout";

	}

}
?>
