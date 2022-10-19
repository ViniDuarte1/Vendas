<?php
session_start();
include('verifica_login.php');
// Executa a conexão ao banco de dados
include 'connect.php';
// Atribui a chave primária para a variável $id. Está vindo do caddisplay.
$id=$_GET['updateid'];
// atribui comando SELECT trazendo apenas o usuário do código informado.
$sql = "select * from usuario where id=$id";
// Result executa o comando SQL no banco conectado
$result = mysqli_query($con, $sql);
// Variável $row recebe os dados do registro selecionado.
$row=mysqli_fetch_assoc($result);
// Move os dados do registro para as variáveis locais.
$id = $row['id'];
$login = $row['login'];
$senha = $row['senha'];
$nome = $row['nome'];
$email = $row['email'];
$master = $row['master'];

// se apertar botão ALTERAR, executa o IF para update.
if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $email= $_POST['email'];
    $master= $_POST['master'];
// Comando para modificar os dados informados na página
    $sql = "update usuario set nome='$nome', email='$email', login='$login',
     senha='$senha', master='$master' where id='$id'";
    //  Executa o comando no banco conectado.
    $result = mysqli_query($con,$sql);
    if ($result) {
        header('location:caddisplay.php'); // se OK, abre o caddisplay.php
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
    <title>Usuário</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Usuário</h1>
        <!-- Prepara método POST para submit no If Update. Linha 20 -->
        <form method="post">
            <div class="form-group">
                <label>Login:</label>
                <!-- Value = valores recebidos do SELECT pelo código GET. Linha 13 -->
                <input type="text" class="form-control" name="login" value="<?php echo $login ?>">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="senha" value="<?php echo $senha ?>">
            </div>
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>">
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <label>Master</label>
                <select name="master" class="form-control" style="width: 100px;">
                    <option value="0" <?php if($master==0) echo "selected"; ?>>Master</option>
                    <option value="1" <?php if($master==1) echo "selected"; ?>>Normal</option>
                </select>   
            </div>
          <!-- Confirma alteração enviando submit no IF Update -->
            <button type="submit" name="submit" class="btn btn-primary">Alterar</button>
          <!-- botão para voltar ao caddisplay sem alterar -->
            <button type="button" class="btn btn-primary"><a href="caddisplay.php" style="color: white;"> Voltar</a></button>
        </form>
    </div>
</body>

</html>
