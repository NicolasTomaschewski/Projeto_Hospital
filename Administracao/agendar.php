<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agendar Operações</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include 'sidebar.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include 'topbar.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Agenda de Operações</h4>
                        </div>
                        <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                        <?php
                            include '../conexao.php';

                            // Função para redirecionar após a ação
                            function redirecionar() {
                                header("Location: " . $_SERVER['PHP_SELF']);
                                exit();
                            }

                            // 1. Criação (Adicionar nova operação)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                                $id_medico = $_POST['id_medico'];
                                $id_paciente = $_POST['id_paciente'];
                                $sala = $_POST['sala'];
                                $data_agendamento = $_POST['data_agendamento'];
                                $data_operacao = $_POST['data_operacao'];
                                $hora = $_POST['hora'];
                                $nome_operacao = $_POST['nome_operacao'];
                                $liberado = isset($_POST['liberado']) ? 1 : 0;

                                $sql = "INSERT INTO Operacoes (id_medico, id_paciente, sala, data_agendamento, data_operacao, hora, nome_operacao, liberado) 
                                        VALUES ('$id_medico', '$id_paciente', '$sala', '$data_agendamento', '$data_operacao', '$hora', '$nome_operacao', '$liberado')";
                                if ($conn->query($sql) === TRUE) {
                                    echo "Nova operação agendada com sucesso!<br>";
                                    ?>
                                    <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                                        <a href="agendar.php" class="btn btn-secondary" style="background-color: #4e73df; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Voltar</a>
                                    </div>
                                    <?php
                                    redirecionar();
                                } else {
                                    echo "Erro ao adicionar: " . $conn->error . "<br>";
                                }
                            }

                            // 2. Leitura (Listar operações)
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_GET['id_operacao'])) {
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
                                            <th>Ações</th>
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
                                                <td>" . ($row["liberado"] ? "Sim" : "Não") . "</td>
                                                <td>
                                                    <a href='?id_operacao=" . $row["id_operacao"] . "'>Editar</a> | 
                                                    <a href='?delete_id=" . $row["id_operacao"] . "'>Excluir</a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>Nenhuma operação encontrada.</td></tr>";
                                }
                                echo "</table><br>";
                            }

                            // 3. Atualização (Editar operação)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
                                $id_operacao = $_POST['id_operacao'];
                                $id_medico = $_POST['id_medico'];
                                $id_paciente = $_POST['id_paciente'];
                                $sala = $_POST['sala'];
                                $data_agendamento = $_POST['data_agendamento'];
                                $data_operacao = $_POST['data_operacao'];
                                $hora = $_POST['hora'];
                                $nome_operacao = $_POST['nome_operacao'];
                                $liberado = isset($_POST['liberado']) ? 1 : 0;

                                $sql = "UPDATE Operacoes SET id_medico='$id_medico', id_paciente='$id_paciente', sala='$sala', 
                                        data_agendamento='$data_agendamento', data_operacao='$data_operacao', hora='$hora', 
                                        nome_operacao='$nome_operacao', liberado='$liberado' WHERE id_operacao='$id_operacao'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "Dados da operação atualizados com sucesso!<br>";
                                    ?>
                                    <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                                        <a href="agendar.php" class="btn btn-secondary" style="background-color: #4e73df; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Voltar</a>
                                    </div>
                                    <?php
                                    redirecionar();
                                } else {
                                    echo "Erro ao atualizar: " . $conn->error . "<br>";
                                }
                            }

                            // 4. Exclusão (Excluir operação)
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
                                $id_operacao = $_GET['delete_id'];

                                $sql = "DELETE FROM Operacoes WHERE id_operacao='$id_operacao'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "Operação excluída com sucesso!<br>";
                                    ?>
                                    <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                                        <a href="agendar.php" class="btn btn-secondary" style="background-color: #4e73df; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Voltar</a>
                                    </div>
                                    <?php
                                    redirecionar();
                                } else {
                                    echo "Erro ao excluir: " . $conn->error . "<br>";
                                }
                            }

                            // Formulário para criar ou editar operações
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_operacao'])) {
                                $id_operacao = $_GET['id_operacao'];
                                $sql = "SELECT * FROM Operacoes WHERE id_operacao='$id_operacao'";
                                $result = $conn->query($sql);
                                $operacao = $result->fetch_assoc();

                                echo "<h3>Editar Operação</h3>";
                                echo "<form method='POST' action=''>
                                        <input type='hidden' name='id_operacao' value='" . $operacao['id_operacao'] . "'>
                                        Nome da Operação: <input type='text' name='nome_operacao' value='" . $operacao['nome_operacao'] . "' required><br>
                                        Médico: <select name='id_medico' required>";
                                
                                $medicos = $conn->query("SELECT id_medico, nome FROM Medicos");
                                while ($medico = $medicos->fetch_assoc()) {
                                    $selected = ($medico['id_medico'] == $operacao['id_medico']) ? 'selected' : '';
                                    echo "<option value='" . $medico['id_medico'] . "' $selected>" . $medico['nome'] . "</option>";
                                }

                                echo "</select><br>Paciente: <select name='id_paciente' required>";
                                $pacientes = $conn->query("SELECT id_paciente, nome FROM Pacientes");
                                while ($paciente = $pacientes->fetch_assoc()) {
                                    $selected = ($paciente['id_paciente'] == $operacao['id_paciente']) ? 'selected' : '';
                                    echo "<option value='" . $paciente['id_paciente'] . "' $selected>" . $paciente['nome'] . "</option>";
                                }

                                echo "</select><br>
                                    Sala: <input type='text' name='sala' value='" . $operacao['sala'] . "' required><br>
                                    Data Agendamento: <input type='date' name='data_agendamento' value='" . $operacao['data_agendamento'] . "' required><br>
                                    Data Operação: <input type='date' name='data_operacao' value='" . $operacao['data_operacao'] . "' required><br>
                                    Hora: <input type='time' name='hora' value='" . $operacao['hora'] . "' required><br>
                                    Liberado: <input type='checkbox' name='liberado' " . ($operacao['liberado'] ? "checked" : "") . "><br>
                                    <input type='submit' name='edit' value='Atualizar Operação'>
                                    </form>";
                            } else {
                                ?>
                                <h3 style="color: white;">Criar Nova Operação</h3>
                                <?php
                                echo "<form method='POST' action=''>
                                        <div></div>
                                        Nome da Operação: <input type='text' name='nome_operacao' required><br>
                                        Médico: <select name='id_medico' required>";
                                
                                $medicos = $conn->query("SELECT id_medico, nome FROM Medicos");
                                while ($medico = $medicos->fetch_assoc()) {
                                    echo "<option value='" . $medico['id_medico'] . "'>" . $medico['nome'] . "</option>";
                                }

                                echo "</select><br>Paciente: <select name='id_paciente' required>";
                                $pacientes = $conn->query("SELECT id_paciente, nome FROM Pacientes");
                                while ($paciente = $pacientes->fetch_assoc()) {
                                    echo "<option value='" . $paciente['id_paciente'] . "'>" . $paciente['nome'] . "</option>";
                                }

                                echo "</select><br>
                                    Sala: <input type='text' name='sala' required><br>
                                    Data Agendamento: <input type='date' name='data_agendamento' required><br>
                                    Data Operação: <input type='date' name='data_operacao' required><br>
                                    Hora: <input type='time' name='hora' required><br>
                                    Liberado: <input type='checkbox' name='liberado'><br>
                                    <input type='submit' name='add' value='Adicionar Operação'>
                                    </form>";
                            }

                            $conn->close();
                        ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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