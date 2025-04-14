<?php

require_once __DIR__ . '/Usuario.php';

class Autenticador
{
    // Pega os usuarios colocados no arquivo JSON 
    public static function carregarUsuarios()
    {
        $caminho = __DIR__ . '/../usuarios.json';
        if (!file_exists($caminho)) return [];

        $dados = json_decode(file_get_contents($caminho), true);
        return array_map(function ($item) {
            return Usuario::fromArray($item);
        }, $dados);
    }

    // salva os usúários criados dentro do arquivo JSON 
    public static function salvarUsuarios($usuarios)
    {
        $dados = array_map(function ($usuario) {
            return $usuario->toArray();
        }, $usuarios);

        file_put_contents(__DIR__ . '/../usuarios.json', json_encode($dados, JSON_PRETTY_PRINT));
    }

    public static function registrar(Usuario $usuario)
    {
        $usuarios = self::carregarUsuarios();
        $usuarios[] = $usuario;
        self::salvarUsuarios($usuarios);
    }

    // Verica e valida se usuário está no arquivo e se a senha está correta.
    public static function autenticar($email, $senha)
    {
        $usuarios = self::carregarUsuarios();

        foreach ($usuarios as $usuario) {
            if ($usuario->getEmail() === $email) {
                if (password_verify($senha, $usuario->getSenha())) {
                    return $usuario;
                }
            }
        }

        return null; 
    }
}