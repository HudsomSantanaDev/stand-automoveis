<?php
include("funcoes.php");


validarSessao();
$idSessao=obterIdSessao();




if(isset($_GET["id"])){
    $idCarro=$_GET["id"];
  
    $conexao=obterConexaoBD();
    $sqlComando="SELECT  utilizadores_stand.id
    FROM carros_stand
    JOIN utilizadores_stand ON carros_stand.utilizador=utilizadores_stand.id
    WHERE carros_stand.id = $idCarro";

    $dadosUtilizadorCarro=mysqli_query($conexao,$sqlComando);
    //echo $dadosUtilizadorCarro;//devolve somente id


if($dadosUtilizadorCarro->num_rows==0){//carro nao existe
header("Location:index.php");
exit;
}



$linha=mysqli_fetch_array($dadosUtilizadorCarro);


$idUtilizadorCarro=$linha["id"];

trocarMensagens($idSessao,$idUtilizadorCarro,$conexao,$idCarro);
header("Location:pedido_test_drive_sucesso.php");

}
else{
    header("Location:index.php");
}

?>