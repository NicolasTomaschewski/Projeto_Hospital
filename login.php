<?php

    include 'conexao.php';
 
    // Processar login
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crm']) && isset($_POST['senha'])) {
        $crm = mysqli_real_escape_string($conn, $_POST['crm']);
        $senha = md5($_POST['senha']);

        // Verificar se o médico existe no banco de dados
        $sql = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verificar a senha com password_verify
            if ($senha == $row['senha']) {
                // Senha correta, iniciando sessão
                $_SESSION['id_medico'] = $row['id_medico'];
                $_SESSION['nome'] = $row['nome'];
                header("Location: Medicos/index.php"); // Página após login (pode ser um painel ou dashboard)
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "CRM não encontrado!";
        }
    } else if (isset($_POST['matricula']) && isset($_POST['senha'])) {
        $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
        $senha = md5($_POST['senha']);

        // Verificar se o médico existe no banco de dados
        $sql = "SELECT * FROM Administradores WHERE matricula = '$matricula'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verificar a senha com password_verify
            if ($senha == $row['senha']) {
                // Senha correta, iniciando sessão
                $_SESSION['id_administrador'] = $row['id_administrador'];
                $_SESSION['nome'] = $row['nome'];

                header("Location: Administracao/index.php"); // Página após login (pode ser um painel ou dashboard)
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Matrícula não encontrada!";
        }
    } else if (isset($_POST['cpf']) && isset($_POST['senha'])){
        $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
        $senha = md5($_POST['senha']);

        // Verificar se o médico existe no banco de dados
        $sql = "SELECT * FROM Pacientes WHERE cpf = '$cpf'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verificar a senha com password_verify
            if ($senha == $row['senha']) {
                // Senha correta, iniciando sessão
                $_SESSION['id_paciente'] = $row['id_paciente'];
                $_SESSION['nome'] = $row['nome'];

                header("Location: Pacientes/index.php"); // Página após login (pode ser um painel ou dashboard)
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "CPF não encontrado!";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Medilab Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">

        <div class="topbar d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a
                            href="mailto:nicolas.tomaschewski@gmail.com">nicolas.tomaschewski@gmail.com</a></i>
                    <i class="bi bi-phone d-flex align-items-center ms-4"><span>(61) 9 9993-6690</span></i>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="https://github.com/NicolasTomaschewski" class="twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://github.com/NicolasTomaschewski" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://github.com/NicolasTomaschewski" class="instagram"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/nicolastomaschewski/" class="linkedin"><i
                            class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div><!-- End Top Bar -->

        <div class="branding d-flex align-items-center">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center me-auto">
                    <!-- Uncomment the line below if you also wish to use an image logo -->
                    <!-- <img src="assets/img/logo.png" alt=""> -->
                    <h1 class="sitename">Medilab</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="index.html">Home<br></a></li>
                        <li><a href="index.html">About</a></li>
                        <li><a href="index.html">Services</a></li>
                        <li><a href="index.html">Departments</a></li>
                        <li><a href="index.html">Doctors</a></li>
                        <li><a href="index.html">Contact</a></li>
                        <li class="dropdown">
                            <a href="#"><span>Login</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul class="dropdown">
                                <li>
                                    <form method="post" action="login.php" class="login-form">
                                        <input type="submit" name="action" value="Médico" class="login-option medico">
                                        <input type="submit" name="action" value="Paciente"
                                            class="login-option paciente">
                                        <input type="submit" name="action" value="Administração"
                                            class="login-option administracao">
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>
    <?php if (isset($erro)) { echo "<p style='color:red;'>$erro</p>"; } ?>
    <div class="form">
        <?php
        $action = $_REQUEST['action'];

        if ($action == "Médico") {
            ?>
            <form action="login.php?action=Médico" method="post">
                <h1>Médico</h1>
                <!-- Nome input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">CRM</label>
                    <input type="text" id="form2Example1" name="crm" class="form-control" required />
                </div>
                <!-- Senha input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Senha</label>
                    <input type="password" id="form2Example2" name="senha" class="form-control" required />
                </div>
                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="remember" id="form2Example31" name="lembrar_me" />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>
                <?php if (isset($erro)): ?>
                    <div class="alert alert-danger"><?= $erro ?></div>
                <?php endif; ?>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>

            <?php
        } elseif ($action == "Paciente") {
            ?>
            <form action="login.php?action=Paciente" method="post">
                <h1>Paciente</h1>
                <!-- Nome input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">CPF</label>
                    <input type="text" id="form2Example1" name="cpf" class="form-control" required />
                </div>
                <!-- Senha input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Senha</label>
                    <input type="password" id="form2Example2" name="senha" class="form-control" required />
                </div>
                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="remember" id="form2Example31" name="lembrar_me" />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>
            <?php
        } elseif ($action == "Administração") {
            ?>
            <form action="login.php?action=Administração" method="post">
                <h1>Administrador</h1>
                <!-- Nome do Administrador input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Matrícula</label>
                    <input type="text" id="form2Example1" name="matricula" class="form-control" required />
                </div>
                <!-- Senha input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Senha</label>
                    <input type="password" id="form2Example2" name="senha" class="form-control" required />
                </div>
                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="remember" id="form2Example31" name="lembrar_me" />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>
            <?php
        }
        ?>
    </div>

    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Medilab</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Brasília - DF</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>(61) 9 9993-6690</span></p>
                        <p><strong>Email:</strong> <span>nicolas.tomaschewski@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href="https://github.com/NicolasTomaschewski"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://github.com/NicolasTomaschewski"><i class="bi bi-facebook"></i></a>
                        <a href="https://github.com/NicolasTomaschewski"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/nicolastomaschewski/"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                        <li><a href="#">Molestiae accusamus iure</a></li>
                        <li><a href="#">Excepturi dignissimos</a></li>
                        <li><a href="#">Suscipit distinctio</a></li>
                        <li><a href="#">Dilecta</a></li>
                        <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nobis illum</h4>
                    <ul>
                        <li><a href="#">Ipsam</a></li>
                        <li><a href="#">Laudantium dolorum</a></li>
                        <li><a href="#">Dinera</a></li>
                        <li><a href="#">Trodelas</a></li>
                        <li><a href="#">Flexo</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Medilab</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>