<?php
// header("Location: https://intranet.cecs.pdx.edu/careers/archives/ece/");
/*$content = file_get_contents('https://intranet.cecs.pdx.edu/careers/archives/ece/');
var_dump($content);
if( $content !== FALSE ) {
  // add your JS into $content
  echo $content;
}*/

// $url = "https://intranet.cecs.pdx.edu/careers/archives/ece/";
$url = "https://intranet.cecs.pdx.edu/careers/archives/";
$rel_url = $_SERVER["REQUEST_URI"];
if(substr($rel_url,0,12) !== "/~dejun/job/") {
    die("invalid url!");
}
$url = $url . substr($rel_url,12);
if(isset($_GET['url'])) {
    $url = str_replace('index.php?url=','',$url);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$url");
curl_setopt($ch, CURLOPT_USERPWD,'dejun:password');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYFEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
$html = curl_exec($ch);
curl_close();

$html = str_replace('href="','href="index.php?url=',$html);
$html = str_replace('href="index.php?url=http','href="http',$html); // don't redirect for other url
$html = str_replace('href="index.php?url=mailto','href="mailto',$html); // don't redirect for mailto
$html = str_replace('href="index.php?url=../../inc','href="../inc',$html); // don't redirect for mailto
echo $html; 
?>
