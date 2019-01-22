<?php
require_once __DIR__  . '/twig/vendor/autoload.php';

$servername = "db";
$user = "starlord";
$pass = "Password99";

if(isset($_GET["search"])){
  try {
      $conn = new PDO("mysql:host=$servername;dbname=week3", $user, $pass);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";

      $searchname = test_input($_GET["search"]);
      $stmt = $conn->prepare("SELECT * FROM person WHERE navn LIKE :name");
      $stmt->bindValue(":name", '%'.$searchname.'%');
      $stmt->execute();

      //$nresult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      echo "<pre>";
      print_r($result);

      }
  catch(PDOException $e)
      {
        echo "Connection failed: " . $e->getMessage();
      }

}



$loader = new Twig_Loader_Filesystem( __DIR__ . '/templates/');
$twig = new Twig_Environment($loader, [
]);

$template = $twig->load('searchcontact.html');
echo $template->render(['title' => "Search for contact", 'contacts'=>$result]);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
