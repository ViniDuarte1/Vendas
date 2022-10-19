<?php
// executa a conexão ao banco de dados
include 'connect.php';
// atribui o código enviado pelo botão EXCLUI do caddisplay
$id=$_GET['deleteid'];

//  move dados para a página
// comando sql para pesquisar o usuário do código informado.
$sql = "select * from produto where id=$id";
// executa o comando select na conexão do banco
$result = mysqli_query($con, $sql);
// associa o resultado do select ao vetor $row
$row=mysqli_fetch_assoc($result);
// move cada campo a uma variável que veio do select
$id       = $row['id'];
$nome     = $row['nome'];
$preco    = $row['preco'];
$cx       = $row['cx'];
$comissao = $row['comissao'];

// se apertar o botão excluir, vai executar o bloco de exclusão abaixo
if (isset($_POST['submit'])) {
    $id = $_GET['deleteid'];
     // comando sql que exclui a linha do código informado $id
    $sql = "delete from produto where id=$id";
    // executa o comando delete no banco conectado
    $result = mysqli_query($con, $sql);
    // se exclusao deu certo, executa o caddisplay. senão exibe mensagem de erro.
    if ($result) {
        header('location:proddisplay.php');
    } else {
        die(mysqli_error($con));
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Usuário</title>
</head>

<body>
    <div class="container">
        <h1>Exclusão de Produtos</h1>
        <!-- bloco de objetos usando POST para ser executado pelo PHP -->
        <form method="post">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>" readonly>
            </div>
            <div class="form-group">
                <label>Preço:</label>
                <input type="text" class="form-control" name="preco" value="<?php echo $preco ?>" readonly>
            </div>
            <div class="form-group">
                <label>Cx</label>
                <input type="text" class="form-control" name="cx" value="<?php echo $cx ?>" readonly>
            </div>
            <div class="form-group">
                <label>Comissão</label>
                <input type="text" class="form-control" name="comissao"
                 value="<?php echo $comissao ?>" readonly>
            </div>
            <!-- botão executado é submit para executar a exclusão no PHP: Linha 22 -->
            <button type="submit" name="submit" class="btn btn-primary">Confirma Exclusão: SIM.</button>
            <!-- botão para voltar para a exibição do cadastro -->
            <button type="button" class="btn btn-primary">
            <a href="proddisplay.php" style="color: white;">NÃO. Voltar.</a></button>
        </form>
    </div>
</body>

</html>
