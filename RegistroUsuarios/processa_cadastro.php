<?php
require_once __DIR__ . '/classes/Usuario.php';
require_once __DIR__ . '/classes/Autenticador.php';

// Faz a leitura do preenchimento dos campos insere a informação com o post
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $nome = trim($_POST['nome'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha'] ?? '');

    if (!$nome || !$email || !$senha) { // valida se todos os campos tão preenchidos
        die("Preencha todos os campos.");
    }

    $usuario = new Usuario($nome, $email, $senha); // cria novo usuário
    Autenticador::registrar($usuario);

    echo "Usuário cadastrado com sucesso! <a href='login.php'>Ir para login</a>";
    exit;
}