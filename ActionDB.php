<?php 
function actionDB($entity,$maxProc){
	require_once 'ConnectionDB.php';
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	for($i=0;$i<$maxProc;$i++){
		$numberProc = $entity->getNumberProc()[$i];
		$numberOOS = $entity->getNumberOOS()[$i];
		$refProc = $entity->getRefProc()[$i];
		$emailProc = $entity->getEmailProc()[$i];
		$query ="INSERT INTO eltoxdb (numberProc, numberOOS, reProc, emailProc) 
		VALUES ('$numberProc','$numberOOS','$refProc','$emailProc')";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		$j=0;
		foreach($entity->getRefOnDoc()[$i]->getRefOnDoc() as $refOnDoc){
			//$refOnDoc = $key[$j];
			$namedoc = $entity->getRefOnDoc()[$i]->getNameDoc()[$j];
			$query ="INSERT INTO dataref (numberProc, refdoc, namedoc) VALUES ('$numberProc','$refOnDoc','$namedoc')";
			$result = mysqli_query($link, $query) or die("Ошибка dataref " . mysqli_error($link)); 
		$j++;
		}
		
	}
	mysqli_close($link);
}

?>