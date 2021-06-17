$(function(){
    /*Chamando a função do botão entrar.*/
    $("button#btnEntrar").on("click", function(e){
        /*Retira a função do butão entrar.*/
        e.preventDefault();
        
        /*Chamando as variáveis email e senha.*/
        var campoEmail = $("form#formularioLogin #email").val();
        var campoSenha = $("form#formularioLogin #senha").val();

        //Verificando se os campos de formulários estão vazios e apresentando mensagem ao usuário.
        //Função trim retira os espaços dos campos como forma de preechimento.
        if(campoEmail.trim() == "" || campoSenha.trim() == ""){
            //.show tranforma o display da div em block
            $("div#mensagem").show().removeClass("red").html("Preencha todos os campos.");

        //Se não executa o AJAX.
        }else{

            /*Enviando os formulários via ajax.*/
            $.ajax({
                url: "acoes/acesso.php",
                type: "POST",
                data: {
                    type: "login",
                    email: campoEmail,
                    senha: campoSenha
                },

                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    /*Estabelecendo o erro de conexão.*/
                    if(retorno["erro"]){
                        //.show tranforma o display da div em block
                        $("div#mensagem").show().addClass("red").html(retorno["mensagem"]);
                    }else{
                        window.location = "pagina.php";
                    }
                },
                

                //Identificando erro no método AJAX.
                error: function(){
                    //.show tranforma o display da div em block
                    $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação");
                }
            });
        }
    });

    $("button#btnCadastrar").on("click", function(e){
        /*Retira a função do butão entrar.*/
        e.preventDefault();
        
        /*Chamando as variáveis email e senha.*/
        var campoEmail = $("form#formularioCadastro #emailCadastro").val();
        var campoSenha = $("form#formularioCadastro #senhaCadastro").val();
        var campoNome = $("form#formularioCadastro #nomeCadastro").val();
        var campoTelefone = $("form#formularioCadastro #telefoneCadastro").val();

        //Verificando se os campos de formulários estão vazios e apresentando mensagem ao usuário.
        //Função trim retira os espaços dos campos como forma de preechimento.
        if(campoEmail.trim() == "" || campoSenha.trim() == "" || campoNome.trim() == "" || campoTelefone.trim() == ""){
            //.show tranforma o display da div em block
            $("div#mensagem").show().removeClass("red").html("Preencha todos os campos.");

        //Se não executa o AJAX.
        }else{

            /*Enviando os formulários via ajax.*/
            $.ajax({
                url: "acoes/acesso.php",
                type: "POST",
                data: {
                    type: "cadastro",
                    email: campoEmail,
                    senha: campoSenha,
                    nome: campoNome,
                    telefone: campoTelefone
                },

                success: function(retorno){
                    retorno = JSON.parse(retorno);
                    /*Estabelecendo o erro de conexão.*/
                    if(retorno["erro"]){
                        //.show tranforma o display da div em block
                        $("div#mensagem").show().addClass("red").html(retorno["mensagem"]);
                    }else{
                        window.location = "pagina.php";
                    }
                },
                

                //Identificando erro no método AJAX.
                error: function(){
                    //.show tranforma o display da div em block
                    $("div#mensagem").show().addClass("red").html("Ocorreu um erro durante a solicitação");
                }
            });
        }
    });


    //Troca o formulário de cadastro para login.
    //Troca o formulário de login para cadastro.
    $("button.change").on("click", function(){
        $("div#formulario").toggleClass("cadastro");

         
        $("form#formularioCadastro").toggle();
        $("form#formularioLogin").toggle();
        
        $("div#textoLogin").toggle();
        $("div#textoCadastro").toggle();
    });
});


