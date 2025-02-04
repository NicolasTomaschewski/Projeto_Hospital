<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resultados</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'topbar.php'; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Liberar Resultados para Pacientes</h4>
                        </div>
                        <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                            <?php
                            // Configurações de conexão com o banco de dados
                            include 'conexao.php';
                            
                            // Função para alternar o status de liberação
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_id'])) {
                                $id_operacao = $_POST['toggle_id'];
                                $liberado = $_POST['status'] == 1 ? 0 : 1;

                                $sql = "UPDATE Operacoes SET liberado='$liberado' WHERE id_operacao='$id_operacao'";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                    ?>
                                    <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                                        <div>
                                            <h1>Status de resultado alterado</h1>
                                        </div>
                                        <div>
                                            <a href="historico.php" class="btn btn-secondary" style="background-color: #4e73df; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Voltar</a>
                                        </div>
                                    </div>
                                    <?php
                                    exit();
                                } else {
                                    echo "Erro ao atualizar status: " . $conn->error . "<br>";
                                }
                            }

                            // Leitura (Listar operações)
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
                                        <th>Liberado</th>
                                    </tr>";
                            
                            $sql = "SELECT o.id_operacao, o.sala, o.data_agendamento, o.data_operacao, o.hora, o.nome_operacao, o.liberado,
                                        m.nome AS medico, p.nome AS paciente
                                    FROM Operacoes o
                                    JOIN Medicos m ON o.id_medico = m.id_medico
                                    JOIN Pacientes p ON o.id_paciente = p.id_paciente";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
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
                                            <td>
                                                <form method='POST' style='display:inline;'>
                                                    <input type='hidden' name='toggle_id' value='" . $row["id_operacao"] . "'>
                                                    <input type='hidden' name='status' value='" . $row["liberado"] . "'>
                                                    <button type='submit' class='btn btn-link'>" . ($row["liberado"] ? "Sim" : "Não") . "</button>
                                                </form>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>Nenhuma operação encontrada.</td></tr>";
                            }
                            echo "</table><br>";

                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
