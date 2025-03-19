<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "circular2";

try
{
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $conn->exec("SET NAMES 'utf8'");
    $conn->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set error mode to exception
    
}
catch(PDOException $e)
{
    echo "connection failed: ".$e->getMessage();
    die();
}

?>