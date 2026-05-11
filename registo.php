<?php
include("funcoes.php");
//registro de ultilizadores
$erros="";
$nome="";
$email="";
//desta vez estamos a testear se estamos a receber dados  do formulario pelo metodo POST, em uma nova tecnica
//De forma similar a $_POST, o array $_SERVER é uma variável global do PHP preenchida pelo próprio PHP que tem inúmeras informações, das quais uma delas é o tipo de método da submissão. Essa informação vem associada à chave REQUEST_METHOD.
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //conexao ao banco de dados
    $conexao= obterConexaoBD();
//variaveis dos campos
    $nome=mysqli_real_escape_string($conexao,$_POST["nome"]);
    $email=mysqli_real_escape_string($conexao,$_POST["email"]);
    $password=mysqli_real_escape_string($conexao,$_POST["password"]);
    $confirmacao=mysqli_real_escape_string($conexao,$_POST["confirm"]);
//validação de campos
//vetor foreach que faz a ligaçao entre os nomes e o valor do campo 
        $validacoesVazio=array(
            "nome"=> $nome,
            "email"=>$email,
            "password"=>$password,
            "confirmacao"=>$confirmacao
        );
        //vai percorrer o array , se algum valor for "" sera adicionado o erro do campo
        foreach($validacoesVazio as $nomeCampo => $valor){
            if($valor == ""){
                $erros.="Preencha o campo $nomeCampo<br>";
            }
        }
        //senha e confirmaçao(coincidem?)
        if($password != $confirmacao){
            $erros.="A palavra passe e a confirmação são diferentes<br>";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $erros.="Email Inválido <br>";
        }
        if(strlen($password) < "8 "){
            $erros.= "A password tem que ter pelo menos 8 caracteres";
        }
        //sem erros vamos a criação do rigisto


        if($erros==""){
            //guardamos a password na variavel hash
            //criptada
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $resultado=mysqli_query($conexao,"INSERT INTO utilizadores_stand
            (email,nome,password)
            VALUES('$email','$nome','$hash')");
            if($resultado==false){
                $erros.="Erro na criação da conta";
            }
            else{
                header("Location:conta_criada.php");
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
                                <h2>Registo</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <section class="registration section_padding ">
            <div class="container">                
                <div class="col-lg-12 col-md-12">
                    <h3 class="text-center">Introduza os dados para o seu registo</h3>
                    
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Nome:</div>
                                <input type="text" value ="<?=$nome?> "class="form-control" id="nome" name="nome" placeholder="Nome">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Email:</div>
                                <input type="text" value="<?=$email?>"class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Password:</div>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Palavra-passe">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Confirmação da password:</div>
                                <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirmação da palavra-passe">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group error"><?=$erros?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <button type="submit" value="submit" class="btn_3">Criar conta</button>
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
    <?php
           /* AVISO:
            As passwords ou palavras-passe nunca devem ser guardadas como são recebidas, sem encriptação, na base de dados. Quando feito dessa forma, é quebrada a segurança da informação a vários níveis:

                Os administradores do site e qualquer pessoa que tenha o acesso à base de dados que ficará online, consegue ver a password de qualquer utilizador registado e, tendo em conta que as passwords tipicamente são re-utilizadas em vários sites, é provável que essa password consiga dar o acesso a outro site.
                Todos os sites são passíveis de serem alvos de ataques de hackers, mesmo os famosos e com alta segurança, como o Facebook ou mesmo o do Pentágono. Quando isso acontece, os atacantes levam toda a informação contida na base de dados e consequentemente ficam com o email e password de todos os utilizadores, o que, quase sempre, lhes concede acessos a outros sites.
                
                
                Hashing é uma forma de codificar qualquer informação de maneira a que não seja descodificável.
                
                
                    

A função utilizada, de nome filter_var, permite validar o email, sendo que o valor a validar surge no primeiro parâmetro e o tipo de validação no segundo parâmetro que, no nosso caso, foi FILTER_VALIDATE_EMAIL. Devolve verdadeiro se o valor for válido ou falso caso contrário.


Existem várias outras validações possíveis, tal como podemos ver na tabela seguinte:

Filtro	Descrição
FILTER_VALIDATE_BOOLEAN	Valida se é um valor booleano
FILTER_VALIDATE_DOMAIN	Valida se é um domínio válido
FILTER_VALIDATE_EMAIL	Valida se é um endereço de email válido
FILTER_VALIDATE_FLOAT	Valida se é um float (número decimal)
FILTER_VALIDATE_INT	Valida se é um inteiro
FILTER_VALIDATE_IP	Valida se é um endereço de IP válido
FILTER_VALIDATE_MAC	Valida se é um endereço MAC válido
FILTER_VALIDATE_REGEXP	Valida se é uma expressão regular válida
FILTER_VALIDATE_URL	Valida se é um url (endereço web) válido
*/
    ?>