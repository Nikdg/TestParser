<?php
function curl_get($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:72.0) Gecko/20100101 Firefox/72.0');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CAINFO, "C:/localhost/cacert.pem");
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
	//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	//curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}