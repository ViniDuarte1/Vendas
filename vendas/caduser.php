<?php
// Conecta ao banco de dados
include 'connect.php';

// SE botão submit vai incluir novo registro
if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $email= $_POST['email'];
    $master= $_POST['master'];
    // Comando SQL que insere um novo usuario
    $sql = "insert into usuario (login, senha, nome, email, master) values
    ('$login', '$senha', '$nome', '$email', '$master')";
    // Comando que executa o SQL na conexão do banco
    $result = mysqli_query($con,$sql);
    // se incluiu novo usuário, abre a página caddisplay.php
    if ($result) {
        header('location:caddisplay.php');
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
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Usuário</h1>
        <!-- Grupo de input para incluir no método POST pelo botão Enviar -->
        <form method="post">
            <div class="form-group">
                <label>Login:</label>
                <input type="text" class="form-control" name="login" style="width: 250px;">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="senha" style="width: 200px;">
            </div>
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" class="form-control" name="nome" style="width: 400px;">
            </div>
            <div class="form-group">
                <label>email</label>
                <input type="email" class="form-control" name="email" style="width: 500px;">
            </div>
            <div class="form-group">
                <label>Master</label>
                <select name="master" class="form-control" style="width: 100px;">
                    <option value="0">Master</option>
                    <option value="1">Normal</option>
                </select>   
            </div>
        <!-- Botão enviar: submit para incluir novo usuário -->
            <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
        <!-- Botão Voltar para o caddisplay sem incluir novo usuário -->
            <button type="button" class="btn btn-primary"><a href="caddisplay.php" style="color: white;"> Voltar</a></button>

        </form>
    </div>
</body>

</html>