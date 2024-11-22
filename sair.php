<?php
// Inicia a sessão (caso ainda não tenha sido iniciada)
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = [];

// Remove o cookie da sessão no cliente (se existir)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroi a sessão
session_destroy();

// Redireciona o usuário
header("Location: index.php");
exit();
