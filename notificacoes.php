<?php
include("funcoes.php");


validarSessao();

$id=obterIdSessao();
$conexao=obterConexaoBD();
 include("cabecalho.php");





?>
<main>
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Notificações</h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <section class="notifications">
        <div class="container">
            <?php
            $notificacoes=mysqli_query($conexao,"SELECT notificacoes_stand.*, carros_stand.modelo , carros_stand.imagem, marcas_stand.marca, utilizadores_stand.nome as de_quem 
            FROM notificacoes_stand
            JOIN utilizadores_stand ON notificacoes_stand.do_utilizador=utilizadores_stand.id
            LEFT JOIN carros_stand ON notificacoes_stand.carro=carros_stand.id
            LEFT JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
            WHERE notificacoes_stand.para_utilizador=$id
            ");
            while($notificacao=mysqli_fetch_array($notificacoes)){
                $mensagem=$notificacao["mensagem"]=="" && $notificacao["mensagem"]==null? "Pedido de teste driver":$notificacao["mensagem"];

            
            ?>
            <div class="notification">
                <?php
                if($notificacao["carro"]!= null){
                    ?>
                    <div class="car">
                        <div class="title"><?= $notificacao["marca"] ?> <?= $notificacao["modelo"] ?></div>
                        <div>
                            <a href="carro.php?id=<?= $notificacao["carro"] ?>">
                                <img src="assets/img/carros/<?= $notificacao["imagem"] ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <?php
                }
                 ?>

                 <div class="from">
                    <i class="fa fa-user"></i>
                    <span class="from-user"><?= $notificacao["de_quem"] ?></span>
                 </div>
                 <div class="message">
                    <i class="fas fa-envelope"></i>
                    <span class="message-text"><?= $mensagem ?></span>
                 </div>
                 <div class="time">
                    <i class="fas fa-clock"></i>
                    <span class="message-text"><?= $notificacao["data_hora"] ?></span>
                 </div>
                 <div class="reply">
                    <a href="responder/<?= $notificacao["id"]?>" class="red-link">Responder</a>
                 </div>
            </div>
            <?php
}
mysqli_query($conexao,"UPDATE notificacoes_stand SET vista=1 WHERE para_utilizador = $id");
            ?>
           
        </div>
    </section>
</main>
<?php
include("rodape.php");
?>