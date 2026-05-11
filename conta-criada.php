<?php
session_start();
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
                                    <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Conta criada</h1>
                                    <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">
                                        Aceda à página de login para iniciar a sessão na sua nova conta.
                                    </p>
                                    <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                        <a href="login.php" class="btn hero-btn">Iniciar Sessão</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   <?php
include("rodape.php");
   ?>