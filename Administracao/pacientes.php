<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CRUD Pacientes</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Pacientes</h1>

                    <!-- Card for CRUD Operations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">CRUD Pacientes</h4>
                        </div>
                        <div class="card-body">
                        <?php
                            include 'conexao.php';

                            // Função de Criação (Adicionar novo médico)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                                $nome = $_POST['nome'];
                                $cpf = $_POST['cpf'];
                                $sql = "INSERT INTO Pacientes (nome, cpf, senha) VALUES ('$nome', '$cpf', md5($cpf))";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Novo médico adicionado com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao adicionar: " . $conn->error . "</div>";
                                }
                            }

                            // Função de Atualização (Editar médico)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
                                $id_paciente = $_POST['id_paciente'];
                                $nome = $_POST['nome'];
                                $cpf = $_POST['cpf'];
                                $sql = "UPDATE Pacientes SET nome='$nome', cpf='$cpf' WHERE id_paciente='$id_paciente'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Dados atualizados com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao atualizar: " . $conn->error . "</div>";
                                }
                            }

                            // Função de Exclusão (Excluir médico)
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
                                $id_paciente = $_GET['delete_id'];
                                $sql = "DELETE FROM Pacientes WHERE id_paciente='$id_paciente'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Médico excluído com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao excluir: " . $conn->error . "</div>";
                                }
                            }

                            // Formulários para criar ou editar médicos
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_paciente'])) {
                                $id_paciente = $_GET['id_paciente'];
                                $sql = "SELECT * FROM Pacientes WHERE id_paciente='$id_paciente'";
                                $result = $conn->query($sql);
                                $paciente = $result->fetch_assoc();
                            ?>
                                <!-- Formulário de edição -->
                                <h3>Editar Paciente</h3>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_paciente" value="<?= $paciente['id_paciente'] ?>">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" value="<?= $paciente['nome'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" class="form-control" value="<?= $paciente['cpf'] ?>" required>
                                    </div>
                                    <input type="submit" name="edit" class="btn btn-primary" value="Atualizar Paciente">
                                </form>
                            <?php
                            } else {
                            ?>
                                <!-- Formulário de criação -->
                                <h3>Criar Novo Paciente</h3>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" class="form-control" required>
                                    </div>
                                    <input type="submit" name="add" class="btn btn-primary" value="Adicionar Paciente">
                                </form>
                            <?php
                            }

                            // Função de Leitura (Listar médicos)
                            echo "<h3>Lista de Pacientes</h3>";
                            $sql = "SELECT * FROM Pacientes";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table table-bordered'>";
                                echo "<tr><th>ID</th><th>Nome</th><th>CPF</th><th>Ações</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_paciente"] . "</td>";
                                    echo "<td>" . $row["nome"] . "</td>";
                                    echo "<td>" . $row["cpf"] . "</td>";
                                    echo "<td>";
                                    echo "<a href='?id_paciente=" . $row["id_paciente"] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                                    echo "<a href='?delete_id=" . $row["id_paciente"] . "' class='btn btn-danger btn-sm'>Excluir</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>Nenhum paciente encontrado.</p>";
                            }

                            // Fechar a conexão
                            $conn->close();
                            ?>
                        </div>

                    </div>
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
