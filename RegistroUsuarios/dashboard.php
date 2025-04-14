<?php
require_once __DIR__ . '/classes/Sessao.php';
Sessao::iniciar();

$usuario = Sessao::get('usuario');

if (!$usuario) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['login']) && $_GET['login'] === 'ok') {
    echo "<p style='color:green;'>Login efetuado!</p>";
}

echo "<h2>Página de acesso para o usuário logado</h2>";
echo "Seja Bem vindo, " . htmlspecialchars($usuario['nome']) . "!<br>";
echo "Você está logado com o email: " . htmlspecialchars($usuario['email']) . "<br>";

if (isset($_COOKIE['email_salvo'])) {
    echo "E-mail salvo para novos logins: " . htmlspecialchars($_COOKIE['email_salvo']) . "<br>";
}

echo "<a href='logout.php'>Sair</a>";
