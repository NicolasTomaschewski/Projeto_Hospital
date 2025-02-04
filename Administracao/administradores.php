<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CRUD Administração</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Administradores</h1>

                    <!-- Card for CRUD Operations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">CRUD Administração</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            include 'conexao.php';

                            // Função de Criação (Adicionar novo médico)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
                                $nome = $_POST['nome'];
                                $matricula = $_POST['matricula'];
                                $sql = "INSERT INTO Administradores (nome, matricula, senha) VALUES ('$nome', '$matricula', md5($matricula))";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Novo médico adicionado com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao adicionar: " . $conn->error . "</div>";
                                }
                            }

                            // Função de Atualização (Editar médico)
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
                                $id_administrador = $_POST['id_administrador'];
                                $nome = $_POST['nome'];
                                $matricula = $_POST['matricula'];
                                $sql = "UPDATE Admnistradores SET nome='$nome', matricula='$matricula' WHERE id_administrador='$id_administrador'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Dados atualizados com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao atualizar: " . $conn->error . "</div>";
                                }
                            }

                            // Função de Exclusão (Excluir médico)
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete_id'])) {
                                $id_administrador = $_GET['delete_id'];
                                $sql = "DELETE FROM Administradores WHERE id_administrador='$id_administrador'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<div class='alert alert-success'>Médico excluído com sucesso!</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>Erro ao excluir: " . $conn->error . "</div>";
                                }
                            }

                            // Formulários para criar ou editar médicos
                            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_administrador'])) {
                                $id_administrador = $_GET['id_administrador'];
                                $sql = "SELECT * FROM Administradores WHERE id_administrador='$id_administrador'";
                                $result = $conn->query($sql);
                                $administrador = $result->fetch_assoc();
                            ?>
                                <!-- Formulário de edição -->
                                <h3>Editar Médico</h3>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_administrador" value="<?= $administrador['id_administrador'] ?>">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" value="<?= $administrador['nome'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>matricula</label>
                                        <input type="text" name="matricula" class="form-control" value="<?= $administrador['matricula'] ?>" required>
                                    </div>
                                    <input type="submit" name="edit" class="btn btn-primary" value="Atualizar Médico">
                                </form>
                            <?php
                            } else {
                            ?>
                                <!-- Formulário de criação -->
                                <h3>Criar Novo Médico</h3>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>matricula</label>
                                        <input type="text" name="matricula" class="form-control" required>
                                    </div>
                                    <input type="submit" name="add" class="btn btn-primary" value="Adicionar Médico">
                                </form>
                            <?php
                            }

                            // Função de Leitura (Listar médicos)
                            echo "<h3>Lista de Médicos</h3>";
                            $sql = "SELECT * FROM Administradores";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                echo "<table class='table table-bordered'>";
                                echo "<tr><th>ID</th><th>Nome</th><th>Matrícula</th><th>Ações</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id_administrador"] . "</td>";
                                    echo "<td>" . $row["nome"] . "</td>";
                                    echo "<td>" . $row["matricula"] . "</td>";
                                    echo "<td>";
                                    echo "<a href='?id_administrador=" . $row["id_administrador"] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                                    echo "<a href='?delete_id=" . $row["id_administrador"] . "' class='btn btn-danger btn-sm'>Excluir</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p>Nenhum médico encontrado.</p>";
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
