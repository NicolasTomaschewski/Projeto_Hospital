<?php 
session_start();

// Configurações de conexão com o banco de dados
$servername = "db";           // Nome do serviço MySQL no Docker
$username = "root";
$password = "rootpassword";   // mesma senha do docker-compose
$dbname = "projeto_hospital";

// Função para aguardar o MySQL estar pronto
$max_attempts = 15;
$attempt = 0;
while ($attempt < $max_attempts) {
    $conn = @new mysqli($servername, $username, $password, $dbname);
    if ($conn && !$conn->connect_error) {
        break; // Conexão bem-sucedida
    }
    $attempt++;
    sleep(2); // espera 2 segundos antes de tentar novamente
}

if (!$conn || $conn->connect_error) {
    die("Conexão falhou após várias tentativas: " . $conn->connect_error);
}
?>
