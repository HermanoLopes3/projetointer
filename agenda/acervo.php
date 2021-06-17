<?php
    /*Inicializando a sessão*/
    session_start();
    
    /*Verifica se usuário está devidamente logado*/
    if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
        require("acoes/conexao.php");
        
        $conexaoClass = new Conexao();
        $conexao = $conexaoClass->conectar();

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
            <?php if($adm==0): ?>
                <div id="subheader">
                    <ul>
                        <li><a href="pagina.php">home</a></li>
                        <li><a href="acervo.php">acervo</a></li>
                        <li><a href="contato.php">contato</a></li>
                    </ul>
                </div>
            <?php endif; ?>    
        </div>
    </body>
</html>