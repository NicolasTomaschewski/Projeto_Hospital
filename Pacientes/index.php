<?php
include '../conexao.php';
include 'relatorio.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Início - Paciente</title>

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Início</h1>
                    </div>

                    <?php
                    include 'seguranca.php';
                    ?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Cirurgias Realizadas -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Operações realizadas este ano</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $finalizados; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cirurgias Agendadas -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Operações agendadas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pendentes; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Acesso Rápido</h4>
                    </div>
                    <div class="card-body" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 10px;">
                        <a href="tables.php" class="btn btn-secondary" style="background-color: #4e73df; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Agenda</a>
                        <a href="historico.php" class="btn btn-secondary" style="background-color: #1cc88a; color: white; text-decoration: none; padding: 10px 20px; display: inline-block;">Operações Finalizadas</a>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Próximo Compromisso</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <?php
                            include '../conexao.php';
                            include 'operacoes.php';
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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

    <style>
        @media (max-width: 600px) {
            .card-body {
                flex-direction: column;
                /* Muda a direção dos itens para coluna em telas menores */
                align-items: center;
                /* Centraliza os itens */
            }

            .btn {
                width: 100%;
                /* Faz os botões ocuparem 100% da largura disponível */
                max-width: 300px;
                /* Limita a largura máxima dos botões */
            }
        }
    </style>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        $(document).ready(function() {
            <?php if ($showModal): ?>
                $('#customModal').modal('show');
            <?php endif; ?>
        });
    </script>


</body>

</html>