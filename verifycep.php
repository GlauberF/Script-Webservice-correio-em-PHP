<?php
//error_reporting(E_ERROR | E_PARSE);
$cep = $_GET['cep'];

function simple_curl($url,$post=array(),$get=array()){
	$url = explode('?',$url,2);
	if(count($url)===2){
            $temp_get = array();
            parse_str($url[1],$temp_get);
            $get = array_merge($get,$temp_get);
	}
 
	$ch = curl_init($url[0]."?".http_build_query($get));
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec ($ch);
}

if ($cep == null) {
	return false;
}else{

	$html = simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do',array(
		'cepEntrada'=>$cep,
		'tipoCep'=>'',
		'cepTemp'=>'',
		'metodo'=>'buscarCep'
	));
	$dom = new DOMDocument();
	$dom->loadHTML($html);

	$xpath = new DOMXPath($dom);

	$attbs = $xpath->query("//span[@class='respostadestaque']");
	foreach($attbs as $a) { 
		$result[] = $a->nodeValue;
	}
	$endereco = explode('-', $result[0]);
	$geo = explode('/', $result[2]);    
	$go[] = array(
		'endereco' => trim($endereco[0]),
		'bairro' => trim($result[1]),                
		'cidade' => trim($geo[0]),               
		'uf' => trim($geo[1]),
		'cep' => $cep
	);
}        
echo json_encode($go);
?>