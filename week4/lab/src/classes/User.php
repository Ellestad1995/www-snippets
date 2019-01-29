<?php

class User {
    private $uid = -1;
    private $dbConnection;

    private $userid;
    private $email;
    private $name;
    private $tlf;
    private $nickname;

    public function __construct($db) {
        $this->dbConnection = $db;
        if (isset($_POST['login'])) {
            $this->login($_POST['email'], $_POST['pass']);
        } else if (isset($_POST['logout'])) {
            unset($_SESSION['uid']);
        } else if (isset($_SESSION['uid'])) {
            $this->uid = $_SESSION['uid'];;
        }
    }


    public function isLoggedIn(){
        return isset($_SESSION['uid']);
    }

    public function getInfo(){
        return array('email'=>$this->email,'name'=>$this->name, 'nickname'=>$this->nickname, 'tlf'=>$this->tlf);
    }

    public function addUser($name, $email, $password, $tlf, $nickname){

        try{

            $password_hashed = $this->hashPassword($password);

            $sql = "INSERT INTO user (name, email, password, tlf, nickname) VALUES (:name,:email, :password, :tlf,:nickname)";
            $prepared_statement = $this->dbConnection->prepare($sql);

            $prepared_statement->bindParam(':name', $name);
            $prepared_statement->bindParam(':email', $email);
            $prepared_statement->bindParam(':password', $password_hashed);
            $prepared_statement->bindParam(':tlf', $tlf);
            $prepared_statement->bindParam(':nickname', $nickname);

            if(!$prepared_statement->execute()){
                // user is NOT created
             return false;
            }

            $this->userid = $this->dbConnection->lastInsertId();
            return true;

        }catch (PDOException $e){
            echo "POST failed: " . $e->getMessage();
            return false;
        }
    }

    /**
     * to parametere: brukernavn og passod
     * Sjekk om brukeren finne si db. Finnes return status=ok og brukerdetaljer lagres i objektet.
     * Bruker ikke finnes return status=fail med info om bruker ikke finnes eller credentials er feil
     *
     */
    public function login($email, $password){
            $status = "";
        try{
            // First check if user exists

            $findUser = "SELECT password FROM user WHERE email=:email";
            $preparedStatement = $this->dbConnection->prepare($findUser);

            $preparedStatement->bindParam(':email',$email);

            $resultStatus = $preparedStatement->execute();
            if($resultStatus) {
                //Select something was possible
                $resultSet = $preparedStatement->fetch(PDO::FETCH_ASSOC);


                $dbPassword = $resultSet['password'];
                if (!password_verify($password, $dbPassword)) {
                    //Wrong password
                    $status = "Wrong password";
                    return $status;
                }
            }
            // user exists and everything is fine
            // Get the user

            $getUser = "SELECT id, email, name, nickname, tlf FROM user WHERE email=:email";
            $prepGetUser = $this->dbConnection->prepare($getUser);

            $prepGetUser->bindParam(':email',$email);
            $getUserResultStatus = $prepGetUser->execute();
            if($getUserResultStatus == true){
                $getUserResult = $prepGetUser->fetch(PDO::FETCH_ASSOC);

                $this->userid = $getUserResult['id'];
                $this->email = $getUserResult['email'];
                $this->nickname = $getUserResult['nickname'];
                $this->name = $getUserResult['name'];
                $this->tlf = $getUserResult['tlf'];

                // Session
                $_SESSION['uid'] = $this->userid;

                $status = "ok";

            }else{$status = "fail";}

            return $status;

        }catch(PDOException $e){
            $status = "login failed: " . $e->getMessage();
        }
        return $status;
    }

    /**
     * @param $userId
     * Delete a user for the specified userid
     */
    public function deleteUser($userId = null){
        $status = "";

       /* if(is_null($userId) && !is_null($this->userid)){
            $deleteid = $this->userid;
        }else if(!is_null($userId) && (is_null($this->userid))){
            $deleteid = $userId;
        }else{
            // No id to delete
            $status = "fail, no id to delete";
            return $status;
        }*/
        $deleteid = $this->userid;
        try {
            $sql = "DELETE FROM user WHERE id=:id";
            $preparedDeleteUser = $this->dbConnection->prepare($sql);

            $preparedDeleteUser->bindParam(':id', $deleteid);
            $resultStatus = $preparedDeleteUser->execute();

            if ($resultStatus == true) {
                $status = "ok";
                return $status;
            } else {
                $status = "fail";
                return $status;
            }

        }catch(PDOException $e){
            $status = "fail: " . $e->getMessage();
        }
        return $status;
    }

    /**
     * @param $password
     * Common function for password hashing
     */
    private function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
