<?php
include_once("funcoes.php");
$lingua = "pt";

if (isset($_COOKIE["lingua"])) {
    $lingua = $_COOKIE["lingua"];
}
include("textos_$lingua.php");
?>
<!doctype html>
<html lang="<?= $lingua ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Stand</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?=URL_BASE?>/assets/img/favicon.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/flaticon.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/slicknav.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/slick.min.css">
    <link rel="stylesheet" href="<?=URL_BASE?>/assets/css/style.css">
</head>

<body>
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="index.php"><img src="<?=URL_BASE?>/assets/img/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="index.php">Início</a></li>
                                    <li><a href="carros"><?= $textos["titulo1"] ?></a></li>
                                    <li><a href="vender"><?= $textos["titulo2"] ?></a></li>
                                    <li><a href="contactos"><?= $textos["titulo3"] ?></a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">
                            <!--include_once == se ja foi inserido o ficheiro , nao incluir-->
                            <?php include_once("funcoes.php"); ?>
                            <ul>
                                <li>
                                    <div class="nav-search search-switch">
                                        <span class="flaticon-search"></span>
                                    </div>
                                </li>
                                <li>
                                    <!--se ha id de utilizador via cookie ,utilizador, se nao va para login-->
                                    <a href="
            
                <?= sessaoIniciada() ? URL_BASE.'/utilizador.php' : URL_BASE.'/iniciar-sessao' ?>"><span class="flaticon-user"></span></a>
                                </li>
                                <li>
                                    <a href="<?=URL_BASE?>/notificacoes">
                                        <span class="flaticon-bell"></span>
                                        <?php
                                        if (sessaoIniciada()) {
                                            //conexao
                                            $conexao = obterConexaoBD();
                                            //id do utilizador
                                            $idUtilizador = obterIdSessao();
                                            //numero de notificaoes nao vistas
                                            $resultadoQuantidadeNotificacoes = mysqli_query($conexao, "SELECT count(*) as quantidade
                            FROM notificacoes_stand
                            WHERE para_utilizador=$idUtilizador and vista =false");
                                            $linha = mysqli_fetch_array($resultadoQuantidadeNotificacoes);
                                            $quantidade = $linha["quantidade"];
                                            if ($quantidade > 0) {
                                                echo ' <div class="notification-count">' . $quantidade . '</div>';

                                            }
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li><a href="<?= URL_BASE ?>/alterar_lingua.php?lingua=pt"><img class="flag first"
                                            src="<?=URL_BASE?>/assets/img/bandeiras/portuguesa.png" alt=""></a></li>
                                <li><a href="<?= URL_BASE ?>/alterar_lingua.php?lingua=en"><img class="flag"
                                            src="<?=URL_BASE?>/assets/img/bandeiras/inglesa.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>