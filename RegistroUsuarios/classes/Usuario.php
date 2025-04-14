<?php

class Usuario
{
    private $nome;
    private $email;
    private $senha;

    // Serve para não deixar com que a senha cripotografe novamente
    public function __construct($nome, $email, $senha, $senha_com_hash = false)
    {
        $this->nome = $nome;
        $this->email = strtolower(trim($email));

        if ($senha_com_hash) {
            $this->senha = $senha;
        } else {
            $this->senha = password_hash($senha, PASSWORD_DEFAULT); 
        }
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function toArray()
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha
        ];
    }

    public static function fromArray($dados)
    {
        return new Usuario($dados['nome'], $dados['email'], $dados['senha'], true);
    }
}