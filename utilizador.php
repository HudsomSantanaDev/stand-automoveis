<?php

include("funcoes.php");
//inicio de sessao
validarSessao();
//se nao for iniciada sessao, sera redirecionado
$id=obterIdSessao();
//id guardados em sessao

$conexao=ObterConexaoBD();

//consulta onde o id inserido corresponde a algum id no banco de dados
$consulta= mysqli_query($conexao,"SELECT * FROM utilizadores_stand WHERE id= $id ");
//infomacoes do ultilizador pela colsta em formato de array
$infoUltilizador= mysqli_fetch_array($consulta);
//variavel para o nome que esta no banco de dados
$nomeUltilizador =$infoUltilizador["nome"];
//variavel para o email que esta no banco de dados
$emailUltilizador=$infoUltilizador["email"];
if(isset($_POST["nome"]) && isset($_POST["email"])){
    $nomeUltilizador= mysqli_real_escape_string($conexao,$_POST["nome"]);
    $emailUltilizador=mysqli_real_escape_string($conexao,$_POST["email"]);

    mysqli_query($conexao,"UPDATE ultilizadores_stand
    SET email ='$emailUltilizador', nome = '$nomeUltilizador' WHERE id=$id");
}

include("cabecalho.php");
?>
    <main>
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Dados <?=$nomeUltilizador?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="user section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3>Alterar dados</h3>
                        <form class="row contact_form" action="#" method="post">
                            <div class="col-md-12 form-group p_star">
                                Nome:
                                <input type="text" value="<?=$nomeUltilizador?>"class="form-control" id="nome" name="nome" placeholder="Nome">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                Email:
                                <input type="text" value="<?=$emailUltilizador?>"class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <button type="submit" value="submit" class="btn_3">Alterar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h3>Sair</h3>
                        <a class="btn_3" href="terminar_sessao.php">Terminar sessão</a>
                    </div>
                </div>
            </div>
        </section>
        <section class=" new-product-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                <div class="section-tittle mb-70">
                    <h2>Meus Carros</h2>
                </div>
                </div>
            </div>
        <div class="row">
        <?php
        $consultaMeusCarros="
        SELECT carros_stand.*, marcas_stand.marca
        FROM carros_stand
        JOIN marcas_stand ON carros_stand.marca=marcas_stand.id
        WHERE utilizador=$id
        ORDER BY data_criacao DESC";

        $meusCarros=mysqli_query($conexao,$consultaMeusCarros);
        while($carro=mysqli_fetch_array($meusCarros)){
         

           
            ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-new-pro mb-30 text-center">
                    <div class="product-img">
                    <img src="assets/img/carros/<?=$carro["imagem"]?>" alt="">
                    </div>
                    <div class="product-caption">
                    <h3><a href="carro.php?id=<?=$carro["id"]?>"><?=$carro["marca"]?></a></h3>
                    <span><?=$carro["preco"]?>€</span>
                    </div>
                    <div class="actions">
                    <a href="vender.php?id=<?=$carro["id"]?>" class="red-link">Editar</a>
                    <a href="remover_carro.php?id=<?=$carro["id"]?>" class="red-link">Remover</a>
                    </div>

                </div>

            </div>
            <?php
        }
        //numero de resultado encontardos
        //se for igual a zero, significa que nao encontramos nenhum resultado, logo o utilizador não tem carros para vender
        $num_resultados=mysqli_num_rows($meusCarros);
        if($num_resultados== 0){
           echo"Sem Carros para venda";
        
        }
        ?>
        </div>
        </div>
        </section>
    </main>
   <?php
include("rodape.php");
   ?>