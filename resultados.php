<?php
require_once "src/Database/Conecta.php";
require_once "src/Services/NoticiaServico.php";
require_once "src/Helpers/Utils.php";
 
$erro = null;
$noticiaServico = new NoticiaServico();

// Obter o valor que foi digitado no campo de busca
$termo = Utils::sanitizar($_GET['busca']);

try {
    $dados = $noticiaServico->buscarNoticias($termo);
} catch (Throwable $e) {
    $erro = "Erro ao fazer a busca no sistema. <br>".$e->getMessage();
}
require_once "includes/cabecalho.php";
?>

<?php if ($erro): ?>
    <p class="alert alert-danger text-center"> <?=$erro?> </p>
<?php endif; ?>
 
<div class="row my-1 mx-md-n1">

    <h2 class="col-12 fs-5 fw-light">
        Você procurou por 
        <span class="badge bg-dark">  <?= $termo ?> </span> e
        obteve <span class="badge bg-info"> <?= count($dados) ?> </span> resultados
    </h2>

    <!-- Se o resultado da busca for zero, faça aparecer: -->

    <?php if (empty($dados)): ?>
        <p class="alert alert-warning text-center"> Nenhum resultado encontrado! </p>
    <?php else: ?>

    <!-- Caso contrário, faça aparecer a div abaixo (usando o foreach) -->
     
    <?php foreach ($dados as $noticia): ?>

        <div class="col-12 my-1">
            <article class="card">
                <div class="card-body">
                    <h3 class="fs-4 card-title fw-light">
                        <?= $noticia['titulo'] ?>
                    </h3>
                    <p class="card-text">
                        <time datetime="<?= $noticia['data'] ?>"> 
                            <?= Utils::formatarData($noticia['data']) ?>
                        </time> - 
                        <?= $noticia['resumo'] ?>
                    </p>
                    
                    <a href="noticia.php?id=<?= $noticia['id'] ?>" 
                    class="btn btn-primary btn-sm">Continuar lendo</a>
                </div>
            </article>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

</div>     


<?php
require_once "includes/rodape.php";
?>