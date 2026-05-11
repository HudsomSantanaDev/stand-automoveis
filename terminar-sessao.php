<?php
/*obrigatorio ter para ter acesso
    session_start();
    //destruir sessao
    session_destroy();
    header("location:login.php");*/
    if(isset($_COOKIE["id"])){
        //se houver vaor id no vetor cookie
        //remova o valor

        unset($_COOKIE["id"]);
        //acaba o cookie
        setcookie("id","",time()-3600);
    }
    header("Location:login.php");
?>