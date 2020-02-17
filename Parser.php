<?php
include "DataFProcedure.php";
include "Util.php";
class Parser{
	private $headUrl = "https://etp.eltox.ru";
	private $headUrlDoc = "http://storage.eltox.ru";
	private $reCountPage = '#<li><a title="Последняя" href="/registry/procedure/page/(.*)" rel="last">#im';
	private $reUrlsPage = '#<dt><a class="btn btn-xs btn-default btn-procedure-read" href="(.*)" title="Просмотр">#im';
	private $reNumberProc = '#<td><span>([0-9]{1,})</span>#im';
	private $reNumberOOS = '#<td><span>([0-9]{9,})</span>#im';
	private $reEmailProc = '#<td>(.{2,}@.*)</td>#im';
	private $refirstUrlDoc = '#"path":"([^,]+)","db"#im';
	private $retwoUrlDoc = '#"name":"([0-9a-z]+.{1,425}\.....?)","alias"#';//'#"name":"([^"]+)","alias"#i';
	private $reNameDoc = '#_(.*\.....?)#';
	private $lastPage;
	private $entityDb ;
	function __construct($html){
		
		preg_match($this->reCountPage, $html, $this->lastPage);
		$this->entityDb = new DataFProcedure;
		
	}
	function getLastPage(){
		
		return $this->lastPage;
		
	}
	function getAllUrls($html){
		
		preg_match_all($this->reUrlsPage,$html,$matches,PREG_SET_ORDER, 0);
		return $matches;
		
	}
	function setEntity($urlReq){
		
		$this->entityDb->setRefProc($this->headUrl.$urlReq);
		$htmlRequestProc = curl_get($this->headUrl.$urlReq);
		preg_match($this->reNumberProc, $htmlRequestProc, $numberProc);
		$this->entityDb->setNumberProc($numberProc[1]);
		preg_match($this->reNumberOOS, $htmlRequestProc, $numbreOOS);
		if($numbreOOS[1]){
			$this->entityDb->setNumberOOS($numbreOOS[1]);
		}else{
			$this->entityDb->setNumberOOS('Не указан');
		}
		preg_match($this->reEmailProc, $htmlRequestProc, $emailProc);
		$this->entityDb->setEmailProc($emailProc[1]);
		preg_match($this->refirstUrlDoc, $htmlRequestProc, $firstUrl);
		preg_match_all($this->retwoUrlDoc, $htmlRequestProc, $twoUrl, PREG_SET_ORDER, 0);
		$dataRefDoc = new DataRef();
		
		foreach($twoUrl as $key){
			
			preg_match($this->reNameDoc, $key[1], $nameDocUrlTwo);
			$nameDocUtf = escape_win($nameDocUrlTwo[1]);	
			$nameUrlUtf = escape_win($key[1]);
			$nameDocUrl = str_replace(" ","%20",$nameUrlUtf);
			$dataRefDoc->setRefOnDoc2($this->headUrlDoc."/".$firstUrl[1]."/".$nameDocUrl, $nameDocUtf);

		}
		
		$this->entityDb->setRefOnDoc($dataRefDoc);

	}
	
	function getEntity(){
		return $this->entityDb;
	}
}
?>