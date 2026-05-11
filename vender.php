<?php
include("funcoes.php");
//validaçao de ultilizador
 validarSessao();

$conexao=obterConexaoBD();
//variaveis dos campos
$idCarro="";
$marca="";
$modelo="";
$cavalos="";
$combustivel="";
$cor="";
$ano="";
$mes="";
$kilometros="";
$preco="";
//verificação do id
if(isset($_GET["id"])){//id implica modo de edição
    $idCarro=$_GET["id"];
    $idUtilizador=obterIdSessao();
    //consulta dos carros do ultilizador pelo id do carro e utilizador
    $carroExisteSQL=" SELECT * FROM carros_stand WHERE utilizador = $idUtilizador AND id =$idCarro";
    $carroExiste=mysqli_query($conexao,$carroExisteSQL);
//se nenhum resultador dor econtrado, voltaremos ao index.php
    if($carroExiste->num_rows===0){
        header("Location:index.php");//editar sobre o carro de outro
        exit;
    }
    //caso esteja tudo certo , vamos carregar todas as informações
    $resultadoCarro=mysqli_query($conexao,"SELECT * FROM carros_stand WHERE id= $idCarro");
    $carro=mysqli_fetch_array($resultadoCarro);

    $marca=$carro["marca"];
    $modelo=$carro["modelo"];
    $cavalos=$carro["n_cavalos"];
    $combustivel=$carro["combustivel"];
    $cor=$carro["cor"];
    $ano=$carro["ano"];
    $mes=$carro["mes"];
    $kilometros=$carro["kilometros"];
    $preco=$carro["preco"];
}

$erros="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $marca=mysqli_real_escape_string($conexao,$_POST["marca"]);
    $modelo=mysqli_real_escape_string($conexao,$_POST["modelo"]);
    $cavalos=mysqli_real_escape_string($conexao,$_POST["cavalos"]);
    $combustivel=mysqli_real_escape_string($conexao,$_POST["combustivel"]);
    $cor=mysqli_real_escape_string($conexao,$_POST["cor"]);
    $ano=mysqli_real_escape_string($conexao,$_POST["ano"]);
    $mes=mysqli_real_escape_string($conexao,$_POST["mes"]);
    $kilometros=mysqli_real_escape_string($conexao,$_POST["kilometros"]);
    $preco=mysqli_real_escape_string($conexao,$_POST["preco"]);

    $id=mysqli_real_escape_string($conexao,$_POST["id"]);
    $modoEdicao=$id==""?false:true;
    $temFoto=$_FILES["foto"]["size"]>0?true:false;

    //validacao de valores inseridos
    if(strlen($preco)==0){
        $erros.="O preço do carro é obrigatório";
    }
    if(strlen($kilometros)==0){
        $erros.="Os Kilometros do carro é obrigatório";
    }
    if(!$modoEdicao||$temFoto){
        //colocamos a ft escolhida 
    $foto= basename($_FILES['foto']['name']);
    $caminhoDestino="assets/img/carros/$foto";

    if(!move_uploaded_file($_FILES['foto']['tmp_name'],$caminhoDestino)){
        $erros.="Erro a mover imagem para o servidor";
    }
    }

    if($erros==""){
        $idUtilizador=obterIdSessao();

            if($modoEdicao){
                $SQLFoto=$temFoto? ", imagem= '$foto'":"";


                $consultaEditar="UPDATE carros_stand SET
                marca='$marca',
                modelo='$modelo',
                cor='$cor',
                n_cavalos=$cavalos,
                combustivel='$combustivel',
                ano=$ano,
                mes=$mes,
                kilometros=$kilometros,
                preco=$preco
                $SQLFoto
                WHERE id = $idCarro";
              

              $resultado=mysqli_query($conexao,$consultaEditar);

              if(!$resultado){
                $erros.="Erro na edição do carro<br>";
              }
              else{
                header("Location: utilizador.php");
              }
            }

            else{

            
        $consultaInserir=" INSERT INTO carros_stand(
        marca,
        modelo,
        cor,
        n_cavalos,
        combustivel,
        ano,
        mes,
        kilometros,
        preco,
        data_criacao,
        imagem,
        utilizador)
        VALUES(
        '$marca',
        '$modelo',
        '$cor',
        '$cavalos',
        '$combustivel',
        '$ano',
        '$mes',
        '$kilometros',
        '$preco',
        now(),
        '$foto',
        $idUtilizador)";

        $resultado=mysqli_query($conexao,$consultaInserir);

        if(!$resultado){
            $erros.="Erro na criacao da Venda <br>";
        }
        else{
            header("Location:carros.php");
        }
    }
 }

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
                                <h2><?=$idCarro==""?"Afixar Carro": "Editar Carro"?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="sell-car section_padding ">
            <div class="container">                
                <div class="col-lg-12 col-md-12">
                    <h3 class="text-center"><?=$idCarro==""?"Detalhes do carro": "Editar detalhes do carro"?></h3>
                    
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1500000"/>
                        <input type="hidden" name="id" value="<?=$idCarro?>">
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Marca:</div>
                                <select name="marca" class="form-control">
                                    <?php
                                    //marcas por ordem alfabetica
                                    $marcas=mysqli_query($conexao,"SELECT * FROM
                                    marcas_stand ORDER BY marca");
                                    //ciclo para percorrer o banco de dados 
                                    while($linha=mysqli_fetch_array($marcas)){
                                        $selecionado="";
                                        if($linha["id"]==$marca){$selecionado="selected";
                                        }
                                        ?>
                                        <!--opcoes com as marcas-->
                                    <option value="<?=$linha["id"]?>"<?=$selecionado?>><?=$linha["marca"]?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Modelo:</div>
                                <input type="text" value="<?=$modelo?>" class="form-control" name="modelo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Cavalos:</div>
                                <input type="number" value="<?=$cavalos?>"class="form-control" name="cavalos">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Combustivel:</div>
                                <select name="combustivel" value="<?=$combustivel?>"class="form-control">
                                    <option value="Gasolina" <?=$combustivel=="Gasolina"?"selected":""?>>Gasolina</option>
                                    <option value="Diesel" <?=$combustivel=="Disel"?"selected": ""?>>Diesel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Ano:</div>
                                <select name="ano" class="form-control">
                                    <?php
                                    //ciclo for usado para gerar opcoes de anos 
                                    // $i=date("y" se refere ao ano atual)
                                    for($i =date("Y");$i>=1900; $i--){
                                        $selecionado="";
                                        if($i==$ano){
                                            $selecionado="selected";
                                        }
                                        ?>
                                        <option value="<?=$i?>"<?=$selecionado?>><?=$i?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Mês:</div>
                                <select name="mes" class="form-control">
                                    <?php
                                    for($i=1;$i<=12;$i++){
                                        $selecionado="";
                                        if($i==$mes){
                                            $selecionado ="selected";
                                        }
                                        ?>
                                        <option value="<?=$i?>"<?=$selecionado?>><?=$i?></option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Kilometros:</div>
                                <input type="number" class="form-control" value="<?=$kilometros?>"name="kilometros">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Preço em €:</div>
                                <input type="number" value="<?=$preco?>"class="form-control" name="preco">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group p_star">
                                <div>Cor:</div>
                                <input type="text" value="<?=$cor?>"class="form-control" name="cor">
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <div>Fotografia do carro:</div>
                                <input type="file" class="form-control" name="foto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group error"><?=$erros?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <!--operador ternario -->
                                <button type="submit" class="btn_3"><?=$idCarro==""?"Afixar": "Editar"?> Carro</button>
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