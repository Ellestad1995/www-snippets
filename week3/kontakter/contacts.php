<?php
require_once __DIR__  . '/twig/vendor/autoload.php';

$servername = "db";
$user = "starlord";
$pass = "Password99";
$databasename = "";


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



// handle form data if method is POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST["addcontact"])){
    //handle new contact
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $mob = test_input($_POST["mob"]);

    //add to database
    try{
      $sql = "INSERT INTO person (navn, email, mob) VALUES (:name,:email,:mob)";
      $prepared_statement = $conn->prepare($sql);

      $prepared_statement->bindParam(':name', $name);
      $prepared_statement->bindParam(':email', $email);
      $prepared_statement->bindParam(':mob', $mob);

      $prepared_statement->execute();
      if($prepared_statement->rowCount() == 1){
        //New person contact added
        $status = "New contact added";

      }else{
        //Something wrong happend
        $status = "Failed adding contact";
      }

    }catch(PDOException $e){
      echo "POST failed: " . $e->getMessage();

    }


  }
}else{

  // Send form if method is GET
  $loader = new Twig_Loader_Filesystem( __DIR__ . '/templates/');
  $twig = new Twig_Environment($loader, [
  ]);

  $template = $twig->load('addcontacts.html');
  echo $template->render(['title' => 'Add contacts']);

}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
