<?php

//declarar as variáveis necessarias para conexão com o banco de dados.
$hostname = "sql311.epizy.com";
$dbname = "epiz_31734008_cantina";
$username = "epiz_31734008";
$password = "4sAiJG9WhHKCp";

try {
    $pdo = new PDO('mysql:host='.$hostname.';dbname='. $dbname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'conexão com o banco de dados conectado';
}catch(PDOException $e){
    echo 'Erro' . $e->getMessage();
}