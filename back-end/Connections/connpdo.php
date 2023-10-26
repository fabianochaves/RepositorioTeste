<?php
$conn = null;
try {

    // dados da conexao:
    $host = 'mysql';
    $port = '3306';
    $database = 'pdv';
    $db_user = 'pdv';
    $db_password = '123';

    $opcoes = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    );

    // instancia a classe
    $conn = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database, $db_user, $db_password, $opcoes);
    $conn->exec("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

} catch (PDOException $e) {
    echo 'Não foi possível se conectar (Aplicação): ' . $e->getMessage();
    exit();
}
?>
