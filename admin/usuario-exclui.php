<?php
require_once "../src/Helpers/Utils.php";
require_once "../src/Services/AutenticacaoServico.php";
AutenticacaoServico::exigirLogin();

AutenticacaoServico::exigirAdmin();
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Usuario.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../includes/cabecalho-admin.php";

$id = $_GET['id'];
$usuarioServico = new UsuarioServico();

/* Se o id passado via URL for o mesmo id do usuário que está logado */
if ( $id == $_SESSION['id'] ) {
    // Neste caso, não vamos possibilitar a exclusão e vamos avisar o usuário
    $erro = "Você não pode excluir seu próprio usuário!";

} else {
    // caso contrário, siga em frente
    try {

       $dados = $usuarioServico->buscarPorId($id);

        if (!$dados) {
            $erro = "Usuário não encontrado";
        } else {
            $usuarioServico->excluirUsuario($id);
        }

    } catch (Throwable $e) {

        $erro = "Erro ao excluir usuário. <br>" . $e->getMessage();

    }

}


?>
<div class="row">

    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">Excluir usuário</h2>

        <?php if (isset($erro)): ?>

            <p class="alert alert-danger text-center"><?=$erro?></p>

        <?php else: ?>

            <p class="alert alert-success text-center">Usuário excluído com sucesso!</p>

        <div class="text-center">

            <a href="usuarios.php" class="btn btn-primary">Voltar</a>

        </div>

        <?php endif; ?>

    </article>
</div>

<?php require_once "../includes/rodape-admin.php"; ?>
