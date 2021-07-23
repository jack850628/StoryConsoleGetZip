<?php
header('Access-Control-Allow-Origin: https://jack850628.github.io');

//$url = 'https://gitlab.com/jack850628/storyconsolestorycollect/-/raw/main/test.zip';
if(!isset($_GET['url'])){
	exit(0);
}
$url = $_GET['url'];
header('Content-Type: application/zip');
header('Content-Transfer-Encoding: Binary'); 
header('Content-disposition: attachment; filename="story.zip"');

$uuid = uniqid();
mkdir($uuid);
chdir($uuid);
`wget $url`;

$fileName = scandir('.')[2];
ob_clean();
$fileSize = readfile('./' . $fileName);
header('Content-Length: ' . $fileSize);

chdir('..');
`rm -rf $uuid`;
