<?php
$dbhost = "localhost";
$dbname	= "marvelsuperheroes"; //change to be your own db name
$dbuser	= "root"; // change to use your own db user
$dbpass	= "123"; // change to use your own database password

try{
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

}catch(PDOException $err){
  echo "Database connection problem. ". $err->getMessage();
  exit();
}
?>