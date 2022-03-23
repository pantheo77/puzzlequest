<?php 
$db_username = 'root';
$db_password = '123';
$db_name = 'marvelsuperheroes';
$db_host = 'localhost';
$item_per_page = 100;


$con = new mysqli($db_host, $db_username, $db_password, $db_name);
//Output any connection error
if ($con->connect_error) {
    die('Error : ('. $con->connect_errno .') '. $con->connect_error);
}
?>