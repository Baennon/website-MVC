<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("utils/includes.php");
session_start();
$data = array_merge($_GET, $_POST, $_FILES);

Header::execute($data)->getHTML();

echo '<div class="main">';

if(isset($data['page'])) {
	$page = $data['page'];
	if(class_exists($page)) {
		$page::execute($data)->getHTML();
	} else {
		$page = "NotFound";
		NotFound::execute($data)->getHTML();
	}
} else {
		$page = "Accueil";
		Accueil::execute($data)->getHTML();
}

echo "</div>";

$cssFiles=$page::getCssFiles();
foreach ($cssFiles as $cssFileName) {
    echo "<link href='css/".$cssFileName.".css' type='text/css' rel='stylesheet'>";
}

$jsFiles=$page::getJsFiles();
foreach ($jsFiles as $jsFileName) {
	echo "<script src='js/".$jsFileName.".js'></script>";
}

?>