<?php
/**
 * Created by PhpStorm.
 * User: joakimellestad
 * Date: 2019-01-29
 * Time: 14:09
 */

session_start();

require_once "classes/User.php";
require_once "classes/DB.php";
require_once "twig/vendor/autoload.php";


$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader, array());

$db = DB::getDBConnection();

$user = new User($db);

if($user->isLoggedIn()){
//Alrady logged in. Show the goodies
    echo $twig->render('index.html',array('loggedin'=>'yes','userdata'=>$user->getInfo()));
}else{
    //Not logged in. Provide login page
    echo $twig->render('index.html',array('loggedin'=>'no'));

}