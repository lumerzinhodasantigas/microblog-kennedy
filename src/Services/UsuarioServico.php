<?php
// src/Services/UsuarioServico.php

class UsuarioServico {
    private PDO $conexao;

    /* Toda vez que criarmos um objeto baseado na classe UsuarioServico,
    este objeto fará uma chamada ao método de conexão da calsse conecta */

    public function __construct()
    {
        $this->conexao = Conecta::getConexao();
    }

    // Metodos CRUD para Usuários 

    // INSERT

    public function inserir( Usuario $dadosUsuario):void {
        $sql = "INSERT INTO usuarios(nome, email, tipo, senha)
                VALUES(:nome, :email, :tipo, :senha)";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosUsuario->getNome());
        $consulta->bindValue(":email", $dadosUsuario->getEmail());
        $consulta->bindValue(":tipo", $dadosUsuario->getTipo());
        $consulta->bindValue(":senha", $dadosUsuario->getSenha());

        $consulta->execute();
    }

    // SELECT
    public function buscar():array {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $consulta = $this->conexao->query($sql);
        return $consulta->fetchAll();
    }
    

}

?>