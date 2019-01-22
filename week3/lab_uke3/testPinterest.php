<?php
require_once "Pinterest.php";
require_once './twig/vendor/autoload.php';

$res = Pinterest::getPins("mathematical riddles fun");

//echo "<img src='{$res[0]}'>";

//echo "<pre>";
//print_r($res);

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array());

//Gonna write some links
//for($c = 0; $c < count($res); $c++){
 //echo "Link #".$c . " " . $res[$c]."<br/>";
#echo $twig->render('index.html', ['links' => $res]);
//}

//Make it look pretty

$pinsWithUrl = Pinterest::getPinsWithUrl("mathematical riddles fun");

#echo "<pre>";
#print_r($pinsWithUrl);

echo $twig->render('index.html', ['links' => $pinsWithUrl]);
