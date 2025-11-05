<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Models/Usuario.php";
require_once "../src/Helpers/Utils.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../includes/cabecalho-admin.php";

$id = $_GET['id'];
$usuarioServico = new UsuarioServico();

try {
    $dados = $usuarioServico->buscarPorId($id);

    if (!$dados) {

        $erro = "Usuário não encontrado";
		
    }

    $usuarioServico->excluirUsuario($id, $conexao);
    Utils::redirecionarPara("usuarios.php");

} catch (Throwable $e) {

    $erro = "Erro ao excluir usuário. <br>" . $e->getMessage();
}
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir usuário
		</h2>

		<p> Usuário excluído com sucesso </p>

		<a href="../admin/usuarios.php">
			<p> Voltar </p>
		</a>
	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>