<?php
// Configurações de conexão com o banco de dados
include '../conexao.php';
session_start();

// Inicializa o contador
$pendentes = 0;

// Consulta para contar as operações pendentes (onde "liberado" é "Não")
$sqlPendentes = "SELECT COUNT(*) AS total_pendentes 
                 FROM Operacoes 
                 WHERE liberado = 'Não' AND id_paciente = '" . $_SESSION['id_paciente'] . "'";
$resultPendentes = $conn->query($sqlPendentes);

if ($resultPendentes && $row = $resultPendentes->fetch_assoc()) {
    $pendentes = $row['total_pendentes'];
}

// Consulta para contar o número total de operações na tabela
$sqlFinalizados = "SELECT COUNT(*) AS total_finalizados 
                   FROM Operacoes 
                   WHERE id_paciente = '" . $_SESSION['id_paciente'] . "'";
$resultFinalizados = $conn->query($sqlFinalizados);

if ($resultFinalizados && $row = $resultFinalizados->fetch_assoc()) {
    $total = $row['total_finalizados'];
    $finalizados = $total - $pendentes;
}

// Fechando a conexão com o banco de dados
$conn->close();
?>