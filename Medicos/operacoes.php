<?php
// Configurações de conexão com o banco de dados
include '../conexao.php';
session_start();

// Exibindo a tabela de operações
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Médico</th>
            <th>Paciente</th>
            <th>Sala</th>
            <th>Data Agendamento</th>
            <th>Data Operação</th>
            <th>Hora</th>
            <th>Operação</th>
        </tr>";

// Consulta para obter registros onde "liberado" seja "Não"
$sql = "SELECT o.id_operacao, o.sala, o.data_agendamento, o.data_operacao, o.hora, 
            o.nome_operacao, o.liberado, m.nome AS medico, p.nome AS paciente
        FROM Operacoes o
        JOIN Medicos m ON o.id_medico = m.id_medico
        JOIN Pacientes p ON o.id_paciente = p.id_paciente
        WHERE o.liberado = 'Não'"; // Filtrando registros com liberado = "Não"

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Iterando sobre os registros filtrados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_operacao"] . "</td>
                <td>" . $row["medico"] . "</td>
                <td>" . $row["paciente"] . "</td>
                <td>" . $row["sala"] . "</td>
                <td>" . $row["data_agendamento"] . "</td>
                <td>" . $row["data_operacao"] . "</td>
                <td>" . $row["hora"] . "</td>
                <td>" . $row["nome_operacao"] . "</td>
            </tr>";
    }
} else {
    // Se não houver registros, nenhuma linha será adicionada, mas o cabeçalho será exibido
    echo "<tr><td colspan='8'>Nenhuma operação pendente.</td></tr>";
}

echo "</table>";

// Fechando a conexão
$conn->close();
?>
