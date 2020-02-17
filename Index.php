<?php
include "Parser.php";
include "CURL.php";
include "ActionDB.php";
	$homePage = curl_get('https://etp.eltox.ru/registry/procedure/page/1?id=&procedure=&oos_id=&company=&inn=&type=1&price_from=&price_to=&published_from=&published_to=&offer_from=&offer_to=&status=');
	$parser = new Parser($homePage);
	$lastPage = 20;//$parser->getLastPage();
	for($m=1;$m<=$lastPage;$m++){
		$html = "https://etp.eltox.ru/registry/procedure/page/$m/?id=&procedure=&oos_id=&company=&inn=&type=1&price_from=&price_to=&published_from=&published_to=&offer_from=&offer_to=&status=";
		$htmlProc = curl_get($html);
		$urlAllpage[$m] = $parser->getAllUrls($htmlProc);
		foreach($urlAllpage[$m] as $key){
			$parser->setEntity($key[1],$m);
		}
	}
	$entity = $parser->getEntity();
	$maxProc = count($entity->getNumberProc());
	require_once 'Table.html';

	actionDB($entity, $maxProc);

?>