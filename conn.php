<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'mitlogindb';

try{
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
}catch (PDOException $e){
    die("Forbindelse fejlede!!" . $e->getMessage());
}