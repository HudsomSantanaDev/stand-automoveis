<?php

if(isset($_GET["lingua"])){
    setcookie("lingua",$_GET["lingua"],time()+ (3600*24*31));


}
header('Location:'.$_SERVER['HTTP_REFERER']);
?>