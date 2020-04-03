<?php
if (empty($_SESSION) || !isset($_SESSION)){
    session_start();
}
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'guest_book';


$dsn = "mysql:host=$host;dbname=$database";

try {
    $conn = new PDO($dsn, $user, $pass);
}catch (PDOException $e){
    die('Подключение не удалось'. $e->getMessage());
}
?>