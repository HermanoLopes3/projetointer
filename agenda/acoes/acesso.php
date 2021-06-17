<?php
    require("conexao.php");

    Class Acesso{
        private $con = null;

        public function __construct($conexao){
            $this->con = $conexao;
        }
        //Função para verificar se tem POST.
        public function send(){
            //Se são tiver aprensenta mensagem de erro.
            if(empty($_POST) || $this->con == null){
                echo json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro interno no servidor."));
                return;
            }
            //Se tiver post envia para o login.
            switch(true){
                case (isset($_POST["type"]) && $_POST["type"] == "login" && isset($_POST["email"]) && isset($_POST["senha"])):
                    echo $this->login($_POST["email"], $_POST["senha"]);
                    break;
            //Se existir post envia cadastro.
                case (isset($_POST["type"]) && $_POST["type"] == "cadastro" && isset($_POST["email"]) && isset($_POST["senha"]) && isset($_POST["nome"]) && isset($_POST["telefone"])):
                    echo $this->cadastro($_POST["email"], $_POST["senha"], $_POST["nome"], $_POST["telefone"]);
                    break;
            }
        }

        public function login($email, $senha){
            $conexao = $this->con;

            $query = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
            $query->execute(array($email, $senha));

            if($query->rowCount()){
                $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];

                session_start();
                $_SESSION["usuario"] = array($user["nome"], $user["adm"], $user["id"]);

                //Quando não tem erro não retorna nenhuma mensagem.
                return json_encode(array("erro" => 0));
            /*Apresentando mensagem de erro ao usuário com JS*/
            }else{
                return json_encode(array("erro" => 1, "mensagem" => "Email e/ou senha incorretos."));
            }
        }

        public function cadastro($email, $senha, $nome, $telefone){
            $conexao = $this-> con;
            //Inserindo os dados do usuário no banco de dados.
            $query = $conexao->prepare("INSERT INTO usuarios (email, senha, nome, telefone, adm) VALUES (?, ?, ?, ?, ?)");

            //Exeutando as informações passadas pelo usuário e informando mensagem de erro no cadastro.
            if($query->execute(array($email, $senha, $nome, $telefone, 0))){
                session_start();
                $_SESSION["usuario"] = array($nome, 0);
                
                return json_encode(array("erro" => 0));
            }else{
                return json_encode(array("erro" => 1, "mensagem" => "Ocorreu um erro ao cadastrar usuario."));
            }
        }
    };

    $conexao = new Conexao();
    $classe  = new Acesso($conexao->conectar());
    $classe->send();
?>