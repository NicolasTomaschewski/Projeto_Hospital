<?php 

    session_start();
   
    // Configurações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "Tomaschewski";
    $dbname = "projeto_hospital";

    // Criando a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificando a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
?>