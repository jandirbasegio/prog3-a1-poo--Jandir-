<?php
require_once __DIR__ . '/classes/Autenticador.php';
require_once __DIR__ . '/classes/Sessao.php';
require_once __DIR__ . '/classes/Usuario.php';

Sessao::iniciar();

// Pega as informações digitadas para verificar no login
$email = filter_var(trim($_POST['email'] ?? ''));
$senha = trim($_POST['senha'] ?? '');
$lembrar = isset($_POST['lembrar_email']);

$usuario = Autenticador::autenticar($email, $senha);

// se o login der certo, cria uma sessão senão cai no else ao final dando a mensagem de aviso
if ($usuario) {
    Sessao::set('usuario', [
        'nome' => $usuario->getNome(),
        'email' => $usuario->getEmail()
    ]);

    if ($lembrar) {
        setcookie('email_salvo', $email, time() + 60 * 60 * 24 * 30);
    }

    header("Location: dashboard.php?login=ok"); // se o login obter sucesso vai para a Dashboard
    exit;
} else {
    echo "E-mail/senha incorretos, Verifique!. <a href='login.php'>Tentar novamente</a>";
}
