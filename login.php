<?php

session_start();
include("funcoes.php");
$erros="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conexao= obterConexaoBD();
//variavel para o campos  email e senha  do BdD
    $email=mysqli_real_escape_string($conexao,$_POST["email"]);
    $password=mysqli_real_escape_string($conexao,$_POST["password"]);
//consuta que tras os resultados em numeros de linhas como um array com o email inserido
    $consulta=mysqli_query($conexao, "SELECT * FROM utilizadores_stand WHERE email = '$email'");
//se a consulta não trazer nada, significa que nao houve resultados para a busca com o email inserido: reusltado, zero
    if($consulta->num_rows==0){
        $erros="Ultilizador ou palavra passe inválidos";
    }
    //se o ultilizador existir vamos obter o hash que foi guardado no processo de registro e comparar com a hash inserida no login
    else{
        //infromacoes do ultilizador
        $infoUltilizador=mysqli_fetch_array($consulta);
        //hash do ultilizador
        $hashUltilizador=$infoUltilizador["password"];
//verificação da senhaInserida e hash
        if(password_verify($password,$hashUltilizador)){
            session_start();
            //vai iniciar uma sessao na +pagina como idUltilizador
           /* $_SESSION["id"]=$infoUltilizador["id"];*/
           /*cookies valido por 1hrs que contem informacao do ultilizador*/
           setcookie("id",$infoUltilizador["id"],time()+604800);

            header("Location:utilizador.php");
        }
        else{
            $erros="Ultilizador ou palavra passe inválidos";
        }
    }
}
include("cabecalho.php");
?>
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Login</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!--================login_part Area =================-->
        <section class="login_part section_padding ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <h2>Novo no nosso site?</h2>
                                <p>Tire partido de todas as vantagens do nosso site. <br>Começe por:</p>
                                <a href="registo.php" class="btn_3">Criar uma conta</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Bem vindo de volta ! <br>
                                    Inicie a sua sessão</h3>
                                <form class="row contact_form" action="#" method="post">
                                    <div class="col-md-12 form-group p_star">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-12 form-group p_star">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Palavra-passe">
                                    </div>
                                    <div class="col-md-12 form-group p_star error"><?=$erros?></div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">Iniciar sessão</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================login_part end =================-->
    </main>
  <?php
    include("rodape.php");
  ?>