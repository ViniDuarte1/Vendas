<?php
session_start();
include('verifica_login.php');
// Executa a conexão ao banco de dados
include 'connect.php';
// Atribui a chave primária para a variável $id. Está vindo do caddisplay.
$id=$_GET['updateid'];
// atribui comando SELECT trazendo apenas o usuário do código informado.
$sql = "select * from vendedor where id=$id";
// Result executa o comando SQL no banco conectado
$result = mysqli_query($con, $sql);
// Variável $row recebe os dados do registro selecionado.
$row=mysqli_fetch_assoc($result);
// Move os dados do registro para as variáveis locais.
$id    = $row['id'];
$nome  = $row['nome'];

// se apertar botão ALTERAR, executa o IF para update.
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
// Comando para modificar os dados informados na página
    $sql = "update vendedor set nome='$nome'
       where id='$id'";
    //  Executa o comando no banco conectado.
    $result = mysqli_query($con,$sql);
    if ($result) {
        header('location:venddisplay.php'); // se OK, abre o caddisplay.php
    } else {
        die(mysqli_error($con)); // se der erro, exibe mensagem e fecha.
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
    <title>Vendedores</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Vendedores</h1>
        <!-- Prepara método POST para submit no If Update. Linha 20 -->
        <form method="post">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" 
                       name="nome" value="<?php echo $nome ?>">
            </div>
          <!-- Confirma alteração enviando submit no IF Update -->
            <button type="submit" name="submit" class="btn btn-primary">Alterar</button>
          <!-- botão para voltar ao caddisplay sem alterar -->
            <button type="button" class="btn btn-primary">
                <a href="venddisplay.php" style="color: white;"> Voltar</a></button>
        </form>
    </div>
</body>

</html>
