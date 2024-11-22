<?php
require('lib/fpdf.php');
include '../conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_operacao'])) {
    $idOperacao = intval($_POST['id_operacao']);

    // Consulta para obter os dados da operação
    $sql = "SELECT o.id_operacao, o.sala, o.data_agendamento, o.data_operacao, o.hora, 
                o.nome_operacao, m.nome AS medico, p.nome AS paciente
            FROM Operacoes o
            JOIN Medicos m ON o.id_medico = m.id_medico
            JOIN Pacientes p ON o.id_paciente = p.id_paciente
            WHERE o.id_operacao = $idOperacao";

    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        // Criando o PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, 'Detalhes da Operacao', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, 'ID Operacao:', 0, 0);
        $pdf->Cell(0, 10, $row['id_operacao'], 0, 1);

        $pdf->Cell(50, 10, 'Medico:', 0, 0);
        $pdf->Cell(0, 10, $row['medico'], 0, 1);

        $pdf->Cell(50, 10, 'Paciente:', 0, 0);
        $pdf->Cell(0, 10, $row['paciente'], 0, 1);

        $pdf->Cell(50, 10, 'Sala:', 0, 0);
        $pdf->Cell(0, 10, $row['sala'], 0, 1);

        $pdf->Cell(50, 10, 'Data Agendamento:', 0, 0);
        $pdf->Cell(0, 10, $row['data_agendamento'], 0, 1);

        $pdf->Cell(50, 10, 'Data Operacao:', 0, 0);
        $pdf->Cell(0, 10, $row['data_operacao'], 0, 1);

        $pdf->Cell(50, 10, 'Hora:', 0, 0);
        $pdf->Cell(0, 10, $row['hora'], 0, 1);

        $pdf->Cell(50, 10, 'Operacao:', 0, 0);
        $pdf->Cell(0, 10, $row['nome_operacao'], 0, 1);

        $pdf->Output();
    } else {
        echo "Erro: Operação não encontrada.";
    }
}
?>
