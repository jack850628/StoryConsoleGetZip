<?php
header('Access-Control-Allow-Origin: https://jack850628.github.io');

//$url = 'https://gitlab.com/jack850628/storyconsolestorycollect/-/raw/main/test.zip';
if(!isset($_GET['url'])){
	echo json_encode([]);
	exit(0);
}
$url = $_GET['url'];
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: Binary'); 
header('Content-disposition: attachment; filename="story.zip"'); 
readfile($url);
