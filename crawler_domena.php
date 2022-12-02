<?php
set_time_limit(0);
error_reporting(0);
					
$gdzie_dodano=$_POST['url'];

$response_array = array();

//$file = 'log.txt';
		
$ch = curl_init();	
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0");
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


	///Odpowiedz www - HTTP
	curl_setopt($ch, CURLOPT_URL, trim($gdzie_dodano));
	curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
    curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_exec($ch);
	$info2 = curl_getinfo($ch);
	
	
	if($info2['http_code']==0){
		$httpCode=0;
		$url_docelowe="-";
		$title_url="-";
	}
	else{

	curl_setopt($ch, CURLOPT_URL, trim($gdzie_dodano));
	curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);   // cancel if below 1 byte/second
    curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60);   // for a period of 30 seconds
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$zmienna=curl_exec($ch);
	$info = curl_getinfo($ch);
	
	$httpCode=$info2['http_code'];
	$url_docelowe=$info['url'];

	///wczytywanie treści strony
	$doc = new DOMDocument();
	@$doc->loadHTML('<?xml encoding="UTF-8">' . $zmienna);
	
	//title
	$titles = $doc->getElementsByTagName('title');
	$metas = $doc->getElementsByTagName('meta');
	$h1s = $doc->getElementsByTagName('h1');
	
	$title_url = trim($titles->item(0)->nodeValue);
	
	$h1 = trim($h1s->item(0)->nodeValue);
	
	foreach ($metas as $tag) {
		if ($tag->getAttribute('name')=="description" || $tag->getAttribute('name')=="DESCRIPTION" || $tag->getAttribute('name')=="Description"){$desc_url=$tag->getAttribute('content');}
		else{}
	}
	//elazienki
	/*
	$temptemp=explode('<div class="name">',$zmienna);
	$temptemp2=explode('</a>',$temptemp[1]);
	$temptemp3=explode('href="',$temptemp2[0]);
	$temptemp4=explode('"',$temptemp3[1]);

	$desc_url = $temptemp4[0];
	*/
	///
	//liquider.eu
	/*
	$temptemp=explode("hrxall-product-review'>",$zmienna);
	$temptemp2=explode(')',$temptemp[1]);
	$temptemp3=explode('(',$temptemp2[0]);
	$desc_url=$temptemp3[1];
	*/
	
	$test = json_encode($title_url);
	if (json_last_error()==5){$title_url = iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($title_url));}
	else{}

	}
//$text_log = file_get_contents($file);
//$text_log .= date('Y-m-d H:i:s')." - ".$gdzie_dodano."\n";
//file_put_contents($file, $text_log);


curl_close($ch);		

print_r(json_encode(array(
  'url' => $gdzie_dodano,
  'http_code' => $httpCode,
  'url_docelowe' => $url_docelowe,
  'title' => $title_url,
  'desc' => $desc_url,
  'h1' => $h1,
  'error' => isset($error) ? $error : false
)));

?>
