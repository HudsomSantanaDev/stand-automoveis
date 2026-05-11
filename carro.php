<?php
include("funcoes.php");
session_start();
//verificação se  existe id, se não exitir vamos a pagina de login.php
if(!isset($_GET["id"])){
    header("Location:index.php");
    exit;
}
$id=$_GET["id"];
$conexao= obterConexaoBD();
//busca das indormações do carro
$resultadoCarro=mysqli_query($conexao,
"SELECT
carros_stand.*,
marcas_stand.marca as marca,
utilizadores_stand.nome as dono,
utilizadores_stand.email as email_dono,
utilizadores_stand.id as idDono
FROM carros_stand
JOIN marcas_stand ON carros_stand.marca=marcas_stand.id
LEFT JOIN utilizadores_stand ON carros_stand.utilizador=utilizadores_stand.id
WHERE carros_stand.id =$id");

$carro=mysqli_fetch_array($resultadoCarro);

include("cabecalho.php");
?>
    <main>
        <!--================Single Product Area =================-->
        <div class="single_product product_image_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="single_product_text text-center">
                            <h3><?=$carro["marca"]?><?=$carro["modelo"]?></h3>
                            <img src="<?=URL_BASE?>/assets/img/carros/<?=$carro["imagem"]?>" alt="">                    
                            <h5 class="price"><?=$carro["preco"]?></h5>
    
                            <h4 class="specs-title">Características</h4>
                            <div class="center-content">
                                <table class="car-specs">
                                    <tr>
                                        <td>Marca</td>
                                        <td><?=$carro["marca"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Modelo</td>
                                        <td><?=$carro["modelo"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Ano</td>
                                        <td><?=$carro["ano"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Mês</td>
                                        <td><?=$carro["mes"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Cor</td>
                                        <td><?=$carro["cor"]?></td>
                                    </tr>
                                </table>
                                <table class="car-specs">
                                    <tr>
                                        <td>Cavalos</td>
                                        <td><?=$carro["n_cavalos"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Kilometros</td>
                                        <td><?=$carro["kilometros"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Combustível</td>
                                        <td><?=$carro["combustivel"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Adicionado em</td>
                                        <td><?=$carro["data_criacao"]?></td>
                                    </tr>
                                    <tr>
                                        <td>Pertence a</td>
                                        <td><?=$carro["dono"]?></td>
                                    </tr>
                                </table>
                               
    
                            </div>
                            <?php
                          


                            if(!proprioDono($carro["idDono"],obterIdSessao())){
                        
                                
                            ?>

                            <div class="card_area specs_btn">
                                <a href="pedir_teste_drive.php?id=<?= $carro["id"]?>" class="btn_3">
                                    <?=sessaoIniciada()?"Marcar test drive" :"nao pode, se inscreve ai";
                                ?>
                                </a>
                            </div>
                            <?php }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Single Product Area =================-->
    </main>
    <?php
    include("rodape.php");
    ?>