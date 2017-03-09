<?php

function isValidUrl($url){ 
	return preg_match('/^http[s]?:\/\/'.  
    '(([0-9]{1,3}\.){3}[0-9]{1,3}'. // IP形式的URL- 199.194.52.184  
    '|'. // 允许IP和DOMAIN（域名）  
    '([0-9a-z_!~*\'()-]+\.)*'. // 域名- www.  
    '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'. // 二级域名  
    '[a-z]{2,6})'.  // first level domain- .com or .museum  
    '(:[0-9]{1,4})?'.  // 端口- :80  
    '((\/\?)|'.  // a slash isn't required if there is no file name  
    '(\/[0-9a-zA-Z_!~\'
\.;\?:@&=\+\$,%#-\/^\*\|]*)?)$/',  
    $url) == 1;
}
function getHost($url){
	preg_match("/^(http:\/\/)?([^\/]+)/i", $url, $matches); 
	$host = $matches[2];
	return $host;
}

if(empty($_GET["cache"])) echo "It works.";
else if ($_GET["cache"]) {
	//$Allowed_Host=array("Volvo","BMW","SAAB");
	
	$URL = $_GET["cache"];
	
	
	if (!isValidUrl($URL)) {
		echo "转接的URL不合法呢~";
		exit;
	}
	
	
	$Host = getHost($URL);
	
	if(empty($_GET["referer"])) $referer = $Host;
	
	//echo $_GET["cache"];
	$hdrs = array(
	  'http' =>array('header' => 
	   "Accept: image/webp,image/*,*/*;q=0.8\r\n" .
	   "Referer: http://.".$referer."/\r\n" .
	   "User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36\r\n" .
	   "Accept-Language: zh-cn,zh;q=0.8,en-us;q=0.5,en;q=0.3\r\n",
	   'timeout'=>5
	  ),
	);
	$context = stream_context_create($hdrs);
	
	header('content-type: image/jpeg'); 
	echo file_get_contents($URL, 0, $context);
}
?>
