<?php
include("funcoes.php");
session_start();
//verificação do carro pelo id
if(isset($_GET["id"])){
    $idCarro=$_GET["id"];
    $idUtilizador=obterIdSessao();

    $conexao=obterConexaoBD();
    //busca pelos carros pelo dono
    $carroExisteSQL="
    SELECT * FROM carros_stand
    WHERE utilizador= $idUtilizador AND id= $idCarro";

    $carroExiste=mysqli_query($conexao,$carroExisteSQL);
//se o resultado enontrado for 0, significa não ertence ao mesmo e voltamos ao inicio
    if($carroExiste->num_rows===0){
    //remover sobre o caro de outro ultilizador
header("Location:index.php");

    }
    else{
        //comandoSQL para deletar o carro do BD
        mysqli_query($conexao,"DELETE FROM carros_stand WHERE id=$idCarro");
        header("Location:utilizador.php");
    }
}
else{
    //caso não tenha id
    //remove chamado sem id, volta para o o index.php
   header("Location:index.php");

}
?>