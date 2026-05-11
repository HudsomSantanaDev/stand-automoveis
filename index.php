
<?php
echo"<pre>";
var_dump($_SERVER);

echo"<br>";
var_dump($_COOKIE);
echo"</pre>";
$lingua="pt";

if(isset($_COOKIE["lingua"])){
    $lingua=$_COOKIE["lingua"];
}
include("textos_$lingua.php");

include("funcoes.php");

session_start();

$conexao=ObterConexaoBD();


include("cabecalho.php");

?>
    <main>
        <!--? slider Area Start -->
        <div class="slider-area">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center slide-bg">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms"><?= $textos["texto6"] ?></h1>
                                    <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">
                                        <?= $textos["texto7"] ?>
                                    </p>
                                    <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                        <a href="carros.html" class="btn hero-btn"><?= $textos["texto3"] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- ? New Product Start -->
        <section class="new-product-area">
            <div class="container">
                <!-- Section tittle -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-tittle mb-70">
                            <h2><?= $textos["texto4"] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <?php
                  //o indice na marcas_stand.id = a marca carros_stand
                  //consulta que ira mostrar em ordem decrecente (pela data de craiacao) os carros no banco de dados com limite de 3 indices(os 3 mais novos)
                $consultaNovasChegadas="
                SELECT carros_stand.*,marcas_stand.marca
                FROM carros_stand
                JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
                ORDER BY data_criacao DESC
                LIMIT 3
                ";
                //resultado encontrado para a consulta
                //apenas 3 resultados
                $novasChegadas=mysqli_query($conexao,$consultaNovasChegadas);
                        //whilw vai percorrer todo o banco de dados e vai faer uma lista com os carros em ordem descrecente na criacao maas so havera 3 pois foi posto o limite na busca
                while($carro = mysqli_fetch_array($novasChegadas)){
                    //imagem , carro e preco buscados no banco de dados refrerente aos 3 ids encontrados
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-new-pro mb-30 text-center">
                        <div class="product-img">
                            <img src="assets/img/carros/<?=$carro["imagem"]?>" alt="">
                        </div>
                        <div class="product-caption">
                            <h3><a href="carros.php?id=<?=$carro["id"]?>"><?=$carro["marca"]?></a></h3>
                            <span><?=$carro["preco"]?>€</span>
                        </div>
                        </div>
                    </div>
                    <?php
                }
                  ?>
                </div>
            </div>
        </section>
        <!--  New Product End -->
       
        <!--? Popular Items Start -->
        <div class="popular-items section-padding30">
            <div class="container">
                <!-- Section tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="section-tittle mb-70 text-center">
                            <h2><?= $textos["texto5"] ?></h2>
                            <p><?= $textos["texto8"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <?php
                    $consultaMaisEconomicos="
                    SELECT carros_stand.*,marcas_stand.marca
                    FROM carros_stand
                    JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
                    ORDER BY preco ASC
                    LIMIT 6
                    ";
                    $maisEconomicos=mysqli_query($conexao,$consultaMaisEconomicos);
                    while($carro=mysqli_fetch_array($maisEconomicos)){
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-popular-items mb-50 text-center">
                                <div class="popular-img">
                                <img src="assets/img/carros/<?=$carro["imagem"]?>" alt="">
                                <div class="img-cap">
                                    <span>Ver</span>
                                </div>
                                <div class="favorit-items">
                                    <span class="flaticon-heart"></span>
                                </div>
                                </div>
                                <div class="popular-caption">
                                <h3><a href="carro.php?id=<?=$carro["id"]?>"><?=$carro["marca"]?></a></h3>
                                <span><?=$carro["preco"]?>€</span>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                    }
                   ?>
                </div>
                <!--as mais novas criações-->
                <div class="popular-items section-padding30">
            <div class="container">
                <!-- Section tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="section-tittle mb-70 text-center">
                            <h2><?= $textos["texto4"] ?></h2>
                            <p><?= $textos["texto14"] ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                   <?php
                    $consultaMaisnovos="
                    SELECT carros_stand.*,marcas_stand.marca
                    FROM carros_stand
                    JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
                    ORDER BY ano DESC, mes DESC
                    LIMIT 6
                    ";
                    $maisnovos=mysqli_query($conexao,$consultaMaisnovos);
                    while($carro=mysqli_fetch_array($maisnovos)){
                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-popular-items mb-50 text-center">
                                <div class="popular-img">
                                <img src="assets/img/carros/<?=$carro["imagem"]?>" alt="">
                                <div class="img-cap">
                                    <span><?= $textos["texto22"] ?></span>
                                </div>
                                <div class="favorit-items">
                                    <span class="flaticon-heart"></span>
                                </div>
                                </div>
                                <div class="popular-caption">
                                <h3><a href="carro.php?id=<?=$carro["id"]?>"><?=$carro["marca"]?></a></h3>
                                <span><?=$carro["preco"]?>€</span>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                    }
                   ?>
                </div>
                <!--Fim das novas criações-->
                <!-- Button -->
                <div class="row justify-content-center">
                    <div class="room-btn pt-70">
                        <a href="catagori.php" class="btn view-btn1"><?=$textos["texto9"] ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popular Items End -->

        <!--? Shop Method Start-->
        <div class="shop-method-area">
            <div class="container">
                <div class="method-wrapper">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-money"></i>
                                <h6><?= $textos["texto2"] ?></h6>
                                <p><?= $textos["texto10"] ?></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-unlock"></i>
                                <h6><?= $textos["texto12"] ?></h6>
                                <p><?= $textos["texto11"] ?></p>
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-mobile"></i>
                                <h6><?= $textos["texto13"] ?></h6>
                                <p><?= $textos["texto15"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->
    </main>
    <?php
    if(!isset($_COOKIE["consentimento"])){
        ?>
        <div class="modal cookies-consent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $textos["texto23"] ?></h5>
                        <button class="close" type="button" data-dismiss="modal" arial-label="Close">
                            <span arial-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?= $textos["texto24"] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" onclick="aceitarCookies()" type="button">Aceitar Cookies</button>
                        <button type="button" class="btn btn-secondary" onclick="aceitarCookies()" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const cookiesModal=document.querySelector(".cookies-consent");
            function aceitarCookies(){
                cookiesModal.style.display="none";
                fetch(`aceitar_cookies.php`);
            }


        </script>
        <?php
    }
    include("rodape.php");

?>