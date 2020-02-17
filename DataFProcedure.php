<?php
class DataFProcedure{
	private $numberProc= array();
	private $numberOOS= array();
	private $refProc= array();
	private $emailProc= array();
	private $refOnDoc = array();
	
	function setNumberProc($numberProc){
		$this->numberProc[] = $numberProc;
	}
	function getNumberProc(){
		return $this->numberProc;
	}
	function setNumberOOS($numberOOS){
		$this->numberOOS[] = $numberOOS;
	}
	function getNumberOOS(){
		return $this->numberOOS;
	}
	function setRefProc($refProc){
		$this->refProc[] = $refProc;
	}
	function getRefProc(){
		return $this->refProc;
	}
	function setEmailProc($emailProc){
		$this->emailProc[] = $emailProc;
	}
	function getEmailProc(){
		return $this->emailProc;
	}
	function setRefOnDoc($dataRef){
		$this->refOnDoc[] = $dataRef;
	}
	function getRefOnDoc(){
		return $this->refOnDoc;
	}
}


class DataRef{
	private $refOnDoc = array();
	private $nameDoc= array();
	function setRefOnDoc2($refOnDoc, $nameDoc){
		$this->refOnDoc[] = $refOnDoc;
		$this->nameDoc[] = $nameDoc;
	}
	function getRefOnDoc(){
		return $this->refOnDoc;
	}
	function getNameDoc(){
		return $this->nameDoc;
	}
}
?>
		