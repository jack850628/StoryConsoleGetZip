<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

define('STORY_DIR', 'story');

//$url = 'https://gitlab.com/jack850628/storyconsolestorycollect/-/raw/main/test.zip';
if(!isset($_GET['url'])){
	echo json_encode([]);
	exit(0);
}
$url = $_GET['url'];

$uuid = uniqid();
mkdir($uuid);
chdir($uuid);
`wget $url`;
$fileName = scandir('.')[2];
system("unzip $fileName -d ".STORY_DIR);
$files = scandir('./'.STORY_DIR);
$storyObj = [];
for($i=2;$i<count($files);$i++){
	$storyObj[explode('.', $files[$i])[0]] = json_decode(file_get_contents('./'.STORY_DIR.'/'.$files[$i]));
}
//var_dump($storyObj);
chdir('..');
`rm -rf $uuid`;
ob_clean();
echo json_encode($storyObj);
