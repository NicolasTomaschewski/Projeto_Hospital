<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alterar Senha</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Alterar Senha</h1>

                    <?php
                        include '../conexao.php';

                        // Definindo uma variável para armazenar a mensagem
                        $mensagem = "";

                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Recuperando os valores das senhas inseridas pelo usuário
                            $senha = $_POST['senha'];
                            $senha_confirmar = $_POST['senha_confirmar'];

                            // Verificando se as senhas são iguais ou diferentes
                            if ($senha === $senha_confirmar) {
                                // As senhas são iguais, criptografa a senha e executa a consulta SQL
                                $mensagem = "As senhas são iguais. Alteração realizada com sucesso!";
                                $senha_criptografada = md5($senha);  // Criptografando a senha

                                // Certifique-se de que a variável $_SESSION['id_medico'] esteja definida corretamente
                                if (isset($_SESSION['id_medico'])) {
                                    $sql = "UPDATE Medicos SET senha = '$senha_criptografada' WHERE id_medico = '$_SESSION[id_medico]'";
                                    
                                    // Executando a consulta SQL
                                    if ($conn->query($sql) === TRUE) {
                                        // Senha foi alterada com sucesso
                                        $mensagem = "Alteração realizada com sucesso!";
                                    } else {
                                        // Se ocorrer algum erro na execução da consulta
                                        $mensagem = "Erro ao alterar a senha: " . $conn->error;
                                    }
                                } else {
                                    $mensagem = "Sessão expirada. Por favor, faça login novamente.";
                                }
                            } else {
                                // As senhas não coincidem
                                $mensagem = "As senhas não coincidem. Tente novamente.";
                            }
                        }
                    ?>

                    <div class="container mt-5">
                            <h2>Altere a sua senha</h2>
                            
                            <!-- Formulário para inserir as senhas -->
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Nova Senha</label>
                                    <input type="password" id="senha" name="senha" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senha_confirmar" class="form-label">Confirmação da Senha</label>
                                    <input type="password" id="senha_confirmar" name="senha_confirmar" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </form>

                            <!-- Exibindo a mensagem de sucesso ou erro -->
                            <?php if ($mensagem): ?>
                                <div class="alert alert-<?php echo $mensagem === 'Alteração realizada com sucesso!' ? 'success' : 'danger'; ?>" role="alert">
                                    <?php echo $mensagem; ?>
                                </div>
                            <?php endif; ?>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>