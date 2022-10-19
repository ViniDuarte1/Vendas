<?php
session_start();
include('verifica_login.php');
// Conecta ao banco de dados
include 'connect.php';

// SE botão submit vai incluir novo registro
if (isset($_POST['submit'])) {
    // $id         = $_POST['id'];
    $idproduto  = $_POST['idproduto'];
    $idvendedor = $_POST['idvendedor'];
    $quantidade = $_POST['quantidade'];
    $preco      = $_POST['preco'];
    $datavenda  = $_POST['datavenda'];
    // Comando SQL que insere um novo usuario
    $sql = "insert into venda 
         (idproduto, idvendedor, quantidade, preco, datavenda) values
    ('$idproduto','$idvendedor','$quantidade','$preco','$datavenda')";
    // Comando que executa o SQL na conexão do banco
    $result = mysqli_query($con,$sql);
    // se incluiu novo usuário, abre a página caddisplay.php
    if ($result) {
        header('location:vsdisplay.php');
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
    <title>Vendas</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Vendas</h1>
        
        <!-- Grupo de input para incluir no método POST pelo botão Enviar -->
        <form method="post">
            <div class="form-group">
                <label>Produto:</label>
                <?php
                  $sql = 'select * from produto order by nome';
                  $result = mysqli_query($con, $sql);
                  if ($result) {
                      echo '<select class="form-control" name="idproduto" style="width: 400px;">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value="'.$row['id']. '">'.$row['nome'].'</option>';
                      }
                      echo '</select>';
                  }
                ?>
                <!-- <input type="text" class="form-control" name="idproduto"> -->
            </div>
            <div class="form-group">
                <label>Vendedor:</label>
                <?php
                  $sql = 'select * from vendedor order by nome';
                  $result = mysqli_query($con, $sql);
                  if ($result) {
                      echo '<select class="form-control" name="idvendedor" style="width: 400px;">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value="'.$row['id']. '">'.$row['nome'].'</option>';
                      }
                      echo '</select>';
                  }
                ?>

            </div>
            <div class="form-group">
                <label>Quantidade:</label>
                <input type="number" class="form-control" name="quantidade">
            </div>
            <div class="form-group">
                <label>Preço:</label>
                <input type="text" class="form-control" name="preco">
            </div>
            <div class="form-group">
                <label>Data Venda:</label>
                <input type="date" class="form-control" name="datavenda">
            </div>
        <!-- Botão enviar: submit para incluir novo usuário -->
            <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
        <!-- Botão Voltar para o caddisplay sem incluir novo usuário -->
            <button type="button" class="btn btn-primary"><a href="vsdisplay.php" style="color: white;"> Voltar</a></button>

        </form>
    </div>
</body>

</html>