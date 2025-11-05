<?php
// src/Services/UsuarioServico.php
require_once "../Models/Usuario.php";

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
    
    // buscarPorId (SELECT)

    public function buscarPorId(int $valorId): array {

        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":id", $valorId);
        $consulta->execute();

        /* Sobre o :? conhecido como "Elvis Operator
        É uma condicional simplificada/abreviada em que,
        se a condição/expressão for válida,
        ela mesam é retornada. Caso contrário, é retornado null */
        return $consulta->fetch() ?: null;

    }

    // atualizar (UPDATE)

    public function atualizar(Usuario $dadosDoUsuario):void {

        $sql = "UPDATE usuario SET 
                        nome = :nome,
                        email = :email, 
                        tipo = :tipo,
                        senha = :senha,

                WHERE id = :id";
        
        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());
        $consulta->bindValue(":id", $dadosDoUsuario->getId());

        $consulta->execute();
    }

}
?>