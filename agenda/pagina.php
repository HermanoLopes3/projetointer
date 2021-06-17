<?php
    /*Inicializando a sessão*/
    session_start();
    
    /*Verifica se usuário está devidamente logado*/
    if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
        require("acoes/conexao.php");
        
        $conexaoClass = new Conexao();
        $conexao = $conexaoClass->conectar();

        $id   = $_SESSION["usuario"][2];
        $adm  = $_SESSION["usuario"][1];
        $nome = $_SESSION["usuario"][0];
    /*Se não direnciona o usuário de volta a index*/
    }else{
        echo "<script>window.location = 'index.php'</script>";
    }
    
?>
<html> 
    <head> 
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style/pagina.css" />
        <title>Página - <?php echo $nome; ?></title>
    </head>
    <?php
            if($adm){
        ?>
        <script type="text/javascript" src="script/jquery.js"></script>
        <script type="text/javascript" src="script/excluirUsuario.js"></script>
        <?php 
            }
        ?>
    <body> 
        <header>
            <div id="content">
                <div id="user">
                    <span><?php echo $adm ? $nome." (ADM)" : $nome; ?></span>
                </div>
                <span id class="logo">Sistema Agenda Online</span>
                <div id="logout">
                    <a href="acoes/logout.php"><button>Sair</button></a>
                </div>
            </div>
        </header>
        <!--Testando se ousuário é administrador.*/-->
        <!--Caso o Usuário seja administrador mostrar dados cadastrados no banco de dados do sistema.*/-->
        <div id="content">
            <?php if($adm): ?> <!--***************Aula 1, verificar como fazer para se usuario não for adm************-->
                <div id="tabelaUsuarios">
                    <span class="title">Lista de usuários</span>

                    <table>
                        <thead>
                            <tr>
                                <td>Email</td>
                                <td>Senha</td>
                                <td>Nome</td>
                                <td>Telefone</td>
                                <td>ADM</td>
                                <td>ID</td>
                                <td>Excluir</td>
                            </tr>                
                        </thead>
                        <tbody>
                            <?php
                                /*Procurando os dados de todos os usuários no banco de dados.*/
                                $query = $conexao->prepare("SELECT * FROM usuarios WHERE id != ?");
                                $query->execute(array($id));
                        
                                $users = $query->fetchAll(PDO::FETCH_ASSOC);
                                
                                /*Repete o processo para todos os usuários encontrados no Banco.*/
                                for($i = 0; $i < sizeof($users); $i++):
                                    $usuarioAtual = $users[$i];
                            ?>
                            <tr>
                                <td><?php echo $usuarioAtual["email"]; ?></td>
                                <td>******</td>
                                <td><?php echo $usuarioAtual["nome"]; ?></td>
                                <td><?php echo $usuarioAtual["telefone"]; ?></td>
                                <td><?php echo $usuarioAtual["adm"]; ?></td>
                                <td><?php echo $usuarioAtual["id"]; ?></td>
                                <td><button class="excluir" idUsuario="<?php echo $usuarioAtual["id"]; ?>">Excluir</button></td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>            
                    </table>
                </div>
            <?php endif; ?>
            <?php if($adm==0): ?>
                <div id="subheader">
                    <ul>
                        <li><a href="pagina.php">home</a></li>
                    </ul>
                </div>
            <div>
                <h1>OBRIGADO POR REALIZAR SEU CADASTRO EM NOSSA AGENDA ONLINE!</h1>
                <p>Agora seus dados estão guardados em nossa agenda digital e nossas administradores podem ter acesso ao seu e-mail e telefone de contato. Não se preocupe que seus dados estão seguros conosco!</p>
            </div>


            <footer>Sistema de agenda online &copy; 2021</footer> 
            <?php endif; ?>    
        </div>
    </body>
</html>