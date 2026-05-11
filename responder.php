<?php
include("funcoes.php");
$conexao=obterConexaoBD();

$idSessao=obterIdSessao();
validarSessao();





if(isset($_GET["id"])){

$idNotificacao=$_GET["id"];
var_dump($idNotificacao);
 $mensagemNotificacao="";
 $resposta=isset($_POST['resposta'])?$_POST['resposta']:"";
  
   //ler a notificacao

   $lerNotificacao="SELECT notificacoes_stand.*, carros_stand.modelo , carros_stand.imagem, marcas_stand.marca, utilizadores_stand.nome as de_quem 
            FROM notificacoes_stand
            JOIN utilizadores_stand ON notificacoes_stand.do_utilizador=utilizadores_stand.id
            LEFT JOIN carros_stand ON notificacoes_stand.carro=carros_stand.id
            LEFT JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
            WHERE notificacoes_stand.id=$idNotificacao;
            ";
            //destintario selecionada por id 


          $notificacao=mysqli_query($conexao,$lerNotificacao);
       

          while($linha=mysqli_fetch_array($notificacao)){
            $linha["mensagem"]=null?"Teste Driver":$linha['mensagem'];//notificacao(mensagem)
       

    
          $ResponderNotificacao="INSERT INTO notificacoes_stand(para_utilizador,carro , do_utilizador,mensagem,vista,data_hora)

VALUES ('$linha[do_utilizador]', '$linha[carro]', '$idSessao','$resposta',false,now())";


$mensagemNotificacao=$linha["mensagem"];
 

          }

  mysqli_query($conexao,$ResponderNotificacao);
}

include("cabecalho.php");


?>
<main>
    <section class="sell-car section-padding">
        <div class="container">
            <div class="col-lg-12  col-md-12">
                <h3 class="text-center">Responder á mensagem: <?= $mensagemNotificacao==""?"marcar Teste-driver":$mensagemNotificacao?></h3>

                <form action="" method="post">
                    <div class="row center ">
                        <div class="col-md-6 form-group p_star">
                            <div>Resposta</div>
                            <textarea name="resposta" id="" class="form-control" cols="30" rows="4" required></textarea>

                        </div>
                    </div>
                    <div class="row center">
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn_3">Responder</button>

                        </div>

                    </div>
                </form>

            </div>
        </div>

    </section>
</main>
<?php
include("rodape.php");
?>