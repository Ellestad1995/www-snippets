<?php
require_once __DIR__  . '/twig/vendor/autoload.php';

$servername = "db";
$user = "starlord";
$pass = "Password99";

$conn = new PDO("mysql:host=$servername;dbname=week3", $user, $pass);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "Connected successfully";

if(isset($_POST["edit"])){
  try {

      $id = test_input($_POST["id"]);
      $name = test_input($_POST["name"]);
      $email = test_input($_POST["email"]);
      $mob = test_input($_POST["mob"]);

      echo "<pre>";
      print_r($id . ", " . $name . "," . $email . ", " . $mob);

      $stmt = $conn->prepare("UPDATE person SET navn=:name, email=:email, mob=:mob WHERE id=:id");
      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":name", $name);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":mob", $mob);
      $stmt->execute();

      echo $stmt->rowCount() . " records UPDATED successfully";

      }
  catch(PDOException $e)
      {
        echo "Connection failed: " . $e->getMessage();
      }

}else{
  $stmt = $conn->prepare("select * from person");
  $stmt->execute();

  //$nresult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $result = $stmt->fetchAll();
}


$loader = new Twig_Loader_Filesystem( __DIR__ . '/templates/');
$twig = new Twig_Environment($loader, [
]);

$template = $twig->load('editcontacts.html');
echo $template->render(['title' => "Edit contact", 'contacts'=>$result]);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
