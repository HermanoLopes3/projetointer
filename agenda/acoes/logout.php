<?php
    /*Inicializando a sessão verificando se o usuário está logado e derrubando a sessão, direcionando usuário para index.*/
    session_start();
    session_destroy();

    echo "<script>window.location = '../index.php'</script>";
?>