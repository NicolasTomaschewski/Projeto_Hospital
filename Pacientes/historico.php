<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Acessar resultados</title>

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

        <?php include 'topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Histórico</h1>
            <p class="mb-4">Histórico de operações realizadas, filtrando resultados liberados.</p>

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
                    <th>Baixar Resultado</th>
                </tr>";

            // Consulta para obter registros onde "liberado" seja "1" (liberado)
            $sql = "SELECT o.id_operacao, o.sala, o.data_agendamento, o.data_operacao, o.hora, 
                            o.nome_operacao, o.liberado, m.nome AS medico, p.nome AS paciente
                    FROM Operacoes o
                    JOIN Medicos m ON o.id_medico = m.id_medico
                    JOIN Pacientes p ON o.id_paciente = p.id_paciente
                    WHERE o.liberado = '1'";

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
                        <td>
                            <form action='gerar_pdf.php' method='POST' target='_blank'>
                                <input type='hidden' name='id_operacao' value='" . $row["id_operacao"] . "'>
                                <button type='submit' class='btn btn-primary'>Gerar PDF</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Nenhuma operação liberada.</td></tr>";
            }

            echo "</table>";

            // Fechando a conexão
            $conn->close();
            ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->


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