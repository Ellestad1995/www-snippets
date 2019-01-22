<?php
require_once __DIR__  . '/twig/vendor/autoload.php';

$servername = "db";
$user = "starlord";
$pass = "Password99";


try {
    $conn = new PDO("mysql:host=$servername;dbname=week3", $user, $pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }

$stmt = $conn->prepare("select * from person");
$stmt->execute();

//$nresult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
echo "<pre>";
print_r($result);

$loader = new Twig_Loader_Filesystem( __DIR__ . '/templates/');
$twig = new Twig_Environment($loader, [
]);

$template = $twig->load('showcontacts.html');
echo $template->render(['contacts' => $result]);
