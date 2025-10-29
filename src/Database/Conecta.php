<?php

    class Conecta {

        private static string $servidor = "localhost";
        private static string $banco = "microblog-kennedy";
        private static string $usuario = "root";
        private static string $senha = "";
        private static ?PDO $conexao = null;

        public static function getConexao(): PDO {

            if (self::$conexao === null) {

                try {

                    self::$conexao = new PDO(
                        "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8",
                         self::$usuario,
                         self::$senha,
                            [
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                            ]
                    ); 

                } catch (PDOException $erro) {

                    die("❌ Erro ao conectar ao banco de dados: " . $erro->getMessage());

                    }

            }

            return self::$conexao;
        }

    }

Conecta::getConexao();

