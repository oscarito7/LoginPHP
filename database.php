<?php
$server = 'localhost';
$username ='root';
$pass ='';
$database = 'login';

try{
    $con = new PDO("mysql:host=$server; dbname=$database;",$username,$pass);
}
catch(PDOException $e){
    die('Connection failed:' .$e->getMessage());

}


?>