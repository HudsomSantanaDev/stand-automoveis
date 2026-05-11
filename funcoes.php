<?php
define("URL_BASE","HTTP://localhost/meusdocs/php/teste-stand-idiomas/stand");


//conexao a base de dados



function obterConexaoBD(){
    return mysqli_connect("localhost","root","","formabase");;
}
//validar se existi sessao iniciada ou redirecionamos para o login
function validarSessao(){
    session_start();
/*isset($_SESSION["id"]) */
    if(!isset($_COOKIE["id"])){
        header("Location:login.php");
        exit;
    }
}
//obter p id com a sessao iniciada
function obterIdSessao(){
    //$_SESSION["id"]
    return $_COOKIE["id"];
}
function sessaoIniciada(){
    // se existir id nos cookies quer dizer que a sessao foi inciada por la 
    return isset($_COOKIE["id"]);
}
function proprioDono($idDonoCarro,$idSessao){
  if($idDonoCarro==$idSessao){
      return true;
  }
  else{
      return false;
  }
}

//Troca de mensagens

Function trocarMensagens($doUtilizador,$paraUtilizador,$conexao,$idCarro){
    mysqli_query($conexao,"INSERT INTO notificacoes_stand
(para_utilizador, carro, do_utilizador,mensagem,vista,data_hora)
VALUES ($paraUtilizador,$idCarro,$doUtilizador,'',false ,now())");


}

?>