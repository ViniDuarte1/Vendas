<?php
session_start();
include('verifica_login.php');
// Executa a conexão ao banco de dados
include 'connect.php';
// Atribui a chave primária para a variável $id. Está vindo do caddisplay.
$id=$_GET['updateid'];
$idproduto=$_GET['upidproduto'];
$idvendedor=$_GET['upidvendedor'];
// atribui comando SELECT trazendo apenas o usuário do código informado.
$sql = "select * from venda where id=$id";
// Result executa o comando SQL no banco conectado
$result = mysqli_query($con, $sql);
// Variável $row recebe os dados do registro selecionado.
$row=mysqli_fetch_assoc($result);
// Move os dados do registro para as variáveis locais.
$id         = $row['id'];
$idproduto  = $row['idproduto'];
$idvendedor = $row['idvendedor'];
$quantidade = $row['quantidade'];
$preco      = $row['preco'];
$datavenda  = $row['datavenda'];

// se apertar botão ALTERAR, executa o IF para update.
if (isset($_POST['submit'])) {
    $idproduto  = $_POST['idproduto'];
    $idvendedor = $_POST['idvendedor'];
    $quantidade = $_POST['quantidade'];
    $preco      = $_POST['preco'];
    $datavenda  = $_POST['datavenda'];

// Comando para modificar os dados informados na página
    $sql = "update venda set idproduto='$idproduto', 
      idvendedor='$idvendedor', quantidade='$quantidade',
      preco='$preco', datavenda='$datavenda'
       where id='$id'";
    //  Executa o comando no banco conectado.
    $result = mysqli_query($con,$sql);
    if ($result) {
        header('location:vsdisplay.php'); // se OK, abre o caddisplay.php
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
    <title>Vendas</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro Vendas</h1>
        <!-- Prepara método POST para submit no If Update. Linha 20 -->
        <form method="post">
        <div class="form-group">
                <label>Produto:</label>
                <?php
                  $sql = 'select * from produto order by nome';
                  $result = mysqli_query($con, $sql);
                  if ($result) {
                      echo '<select class="form-control" name="idproduto" style="width: 400px;">';
                      while ($row = mysqli_fetch_assoc($result)) {
                          if ($row['id']==$idproduto) {
                            echo '<option value="'.$row['id']. '" selected>'.$row['nome'].'</option>';
                          } else
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
                         if ($row['id']==$idvendedor) {
                            echo '<option value="'.$row['id']. '" selected>'.$row['nome'].'</option>';
                         } else
                          echo '<option value="'.$row['id']. '">'.$row['nome'].'</option>';
                      }
                      echo '</select>';
                  }
                ?>

            </div>
            <div class="form-group">
                <label>Quantidade:</label>
                <input type="number" class="form-control" name="quantidade" value="<?php echo $quantidade; ?>">
            </div>
            <div class="form-group">
                <label>Preço:</label>
                <input type="text" class="form-control" name="preco" value="<?php echo $preco; ?>">
            </div>
            <div class="form-group">
                <label>Data Venda:</label>
                <input type="date" class="form-control" name="datavenda" value="<?php echo $datavenda; ?>">
            </div>
          <!-- Confirma alteração enviando submit no IF Update -->
            <button type="submit" name="submit" class="btn btn-primary">Alterar</button>
          <!-- botão para voltar ao caddisplay sem alterar -->
            <button type="button" class="btn btn-primary">
                <a href="vsdisplay.php" style="color: white;"> Voltar</a></button>
        </form>
    </div>
</body>

</html>
