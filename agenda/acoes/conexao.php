<?php 

    //Criando uma classe privada para conexão.
    Class Conexao{
        /* Estabelecendo a conexão com o banco de dados*/
        private $server = "127.0.0.1"; 
        private $usuario = "root";
        private $senha = "root";
        private $banco = "banco_agenda";

        public function conectar(){
                    /*Testando fazer algo e entrando em uma condição posterior  (TRY, CATCH)*/
            try{
            /*Defininindo o tipo de conexão utilizada PDO*/
            $conexao = new PDO("mysql:host=$this->server;dbname=$this->banco", $this->usuario, $this->senha);
            /*Setando o relatório de erro de conexão*/
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $erro){
                $conexao = null;
            }
        
            return $conexao;
        }
    };
    



?>