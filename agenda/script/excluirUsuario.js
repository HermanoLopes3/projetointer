$(function(){

    //Chamando o botão excluir
    $("button.excluir").on("click", function(){
        //Puxa o id usuário para o botão para fazer a exlusão no banco.
        var idUsuario = $(this).attr("idUsuario");

        $.ajax({
            url: "acoes/excluirUsuario.php",
            type: "POST",
            data: {
                id: idUsuario
            },

            success: function(retorno){
                retorno = JSON.parse(retorno);
                
                if(retorno["erro"]){
                    alert("Erro");
                }else{
                    window.location = window.location.href;
                }
            },

            error: function(){
                alert("Erro");
            }
        });
    });
});