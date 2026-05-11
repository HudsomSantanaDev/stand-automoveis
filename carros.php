<?php
include("funcoes.php");
session_start();
$conexao = obterConexaoBD();
include("cabecalho.php");

$carrosPorPagina=15;
if(isset($_GET["carrosPorPagina"])){
    $carrosPorPagina=intval($_GET["carrosPorPagina"]);
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = intval($_GET["pagina"]);
}

//var_dump($_GET["carrosPorPagina"]);//devolve

?>
<main>
    <!--? Popular Items Start -->
    <div class="popular-items">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Carros</h2>
                        <p>Todos os carros disponíveis no stand online</p>
                    </div>
                </div>
            </div>
            <div class="page-items">
                <span>Carros por página</span>
                <form method="get">
                    <select name="carrosPorPagina" id="carrosPorPagina" class="form-control">
                        <option value="<?= $carrosPorPagina?>"><?= $carrosPorPagina ?></option>
                        <option value="9">9</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="60">60</option>
                    </select>
                    <input type="hidden" name="pagina" value="<?= $pagina ?>">
                </form>
            </div>
            <div class="row">


                <?php
                //var_dump($carrosPorPagina);//não existe??
                
                $carrosPorPagina = isset($_GET["carrosPorPagina"]) ? $_GET["carrosPorPagina"] : 10;
                $pagina = 1;
                if (isset($_GET["pagina"])) {
                    $pagina = intval($_GET["pagina"]);
                }
                $inicio = ($pagina - 1) * $carrosPorPagina;
                $consultaTodosCarros = "
                SELECT carros_stand.*, marcas_stand.marca
                FROM carros_stand
                JOIN marcas_stand ON carros_stand.marca = marcas_stand.id
                ORDER BY data_criacao DESC
                LIMIT $inicio, $carrosPorPagina;
                ";
                $todosCarros = mysqli_query($conexao, $consultaTodosCarros);
                while ($carro = mysqli_fetch_array($todosCarros)) {
                    ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-popular-items mb-50 text-center">
                            <div class="popular-img">
                                <img src="<?=URL_BASE?>/assets/img/carros/<?= $carro["imagem"] ?>" alt="">
                                <div class="img-cap">
                                    <span>Ver</span>
                                </div>
                                <div class="favorit-items">
                                    <span class="flaticon-heart"></span>
                                </div>
                            </div>
                            <div class="popular-caption">
                                <h3><a href="carro/<?=  $carro["id"] ?>"><?= $carro["marca"] ?></a></h3>
                                <span><?= $carro["preco"] ?></span>
                            </div>

                        </div>
                    </div>
                    <?php
                }

                $_GET["carrosPorPagina"] = $carrosPorPagina;
                ?>
            </div>
        </div>
    </div>
    <!-- Popular Items End -->

    <div class="pagination-links">
        <div class="container">
            <div class="links">
                <?php
                $paginaInicial = $pagina - 3;
                if ($paginaInicial < 1) {
                    $paginaInicial = 1;
                }

                //contar carros
                $qtdCarrosConsulta = mysqli_query($conexao, "SELECT count(*) as quantidade FROM carros_stand");

                $linha = mysqli_fetch_array($qtdCarrosConsulta);

                $qtdCarros = $linha["quantidade"];
                $qtdPaginas = ceil($qtdCarros / $carrosPorPagina);

                $paginaFinal = $pagina + 3;
                if ($paginaFinal > $qtdPaginas) {
                    $paginaFinal = $qtdPaginas;
                }

                if ($pagina > $paginaInicial) {
                    $paginaAnterior = $pagina - 1;

                    echo '<div><a href="carros.php?pagina=' . $paginaAnterior . '&carrosPorPagina=' . $carrosPorPagina . '">&lt;</a></div>';
                }

                for ($i = $paginaInicial; $i <= $paginaFinal; $i++) {
                    $classCSS = '';
                    if ($i == $pagina) {
                        $classCSS = 'class="active"';
                    }

                    ?>


                    <div><a href="carros.php?pagina=<?= $i ?>&carrosPorPagina=<?= $carrosPorPagina ?>" <?= $classCSS ?>>
                            <?= $i ?> </a> </div>
                    <?php
                }
                if ($pagina < $paginaFinal) {
                    $paginaSeguinte = $pagina + 1;
                    echo '<div><a href="carros.php?pagina=' . $paginaSeguinte . '&carrosPorPagina=' . $carrosPorPagina . '">&gt;</a></div>';
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
include("rodape.php");
?>