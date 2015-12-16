<?php
header ("Content-type: image/png");

$userName = $_GET["user"];

$url = "http://www.reddit.com/user/" . $userName . "/about.json";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERAGENT, 'RedditBadge 1.0 by r-w.co');
$recived_content = curl_exec($ch); 
$obj = json_decode($recived_content);

$im = imagecreatefrompng("RedditBG.png");

$backgroundColor = imagecolorallocate ($im, 255, 255, 255);
$textColor = imagecolorallocate ($im, 0, 0, 0);
imagestring ($im, 3, 65, 8,  $obj->{'data'}->{'name'}, imagecolorallocate ($im, 0, 0, 0));
imagestring ($im, 2, 65, 23, "Karma - " . $obj->{'data'}->{'link_karma'}, imagecolorallocate ($im, 0, 0, 0));
imagestring ($im, 2, 65, 38, "Comment karma - " . $obj->{'data'}->{'comment_karma'}, imagecolorallocate ($im, 0, 0, 0));	

$transparent = imagecolorallocate($im, 255, 0, 0);
imagecolortransparent($im, $transparent);
imagepng($im);
imagedestroy($im);

?>