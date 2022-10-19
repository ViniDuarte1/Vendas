<?php
session_start();
include('verifica_login.php');
// conectar ao banco de dados
include 'connect.php';
// informar o comando select para exibir
$sql = 'SELECT S.ID id, S.IDPRODUTO idproduto, P.NOME produto, 
        S.IDVENDEDOR idvendedor, V.NOME vendedor,
        S.QUANTIDADE quantidade, S.PRECO preco, S.DATAVENDA datavenda
     FROM VENDA S, PRODUTO P, VENDEDOR V
     WHERE P.ID = S.IDPRODUTO AND V.ID = S.idvendedor';
// ao apertar button Consulta, submit para pesquisa parcial.
$pesqprod = "";
$vmes = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
$pesmes = '';
$vlistames = '0';
$pesqano = '';
$datadeate = '';

if (isset($_POST['submit'])) {
    $pesqnome = $_POST['pesqnome'];
    //condição do produto
    $comboproduto = $_POST['comboproduto'];
    if ($comboproduto != "") {
        $pesqprod = " and s.idproduto=" . $comboproduto;
    }
    //condição do mes
    $vlistames = $_POST['vlistames'];
    if ($vlistames != '0') {
        $pesmes = ' and month(s.datavenda)=' . $vlistames;
    }
    //condiçao do ano
    $vlistaano = $_POST['vlistaano'];
    if ($vlistaano != '0') {
        $pesqano = ' and year(s.datavenda)=' . $vlistaano;
    }
    //condiçao do datadeate
    // puxando valor do input
    $datade = $_POST['datade'];
    $dataate = $_POST['dataate'];
    if ($datade != '' || $dataate != ''){
    $datadeate = ' and s.datavenda between "' .$datade. '" and "' .$dataate. '"';
    }

        
    $sql = 'SELECT S.ID id, S.IDPRODUTO idproduto, P.NOME produto, 
    S.IDVENDEDOR idvendedor, V.NOME vendedor,
    S.QUANTIDADE quantidade, S.PRECO preco, S.DATAVENDA datavenda
 FROM VENDA S, PRODUTO P, VENDEDOR V
 WHERE P.ID = S.IDPRODUTO AND V.ID = S.idvendedor AND v.nome like "%' . $pesqnome . '%"' . $pesqprod . $pesmes . $pesqano. $datadeate;
} else {
    $pesqnome = '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Relatorio de Vendas</title>
</head>

<body>
<div class="alert alert-primary" style="text-align: right;">
        Olá, <a href="caddisplay.php"> <?php echo $_SESSION['login']; ?>
        </a>
        <!-- Botão Menu para voltar à tela principal do sistema -->
        <button type="button" class="btn btn-primary">
            <a href="menu.php" style="color: white;"> Menu</a></button>
        <!-- Botão Menu para sair do sistema -->
        <button type="button" class="btn btn-primary">
            <a href="logout.php" style="color: white;">Sair</a></button>
        </a>
    </div>
    <!-- prepara button submit para executar consulta no PHP-->
    <form method="post">
        <div class="container">
            <br>
            <div class="container">
                <div class="jumbotron" style="padding-top: 2px; padding-bottom: 12px;">
                    <h3 class="text-center">Pesquisa Vendas</h3>
                    <div class="row">
                        <div class="col">
                            <!-- valor a ser inserido como like no Select Linha 9 -->
                            <input type="text" name="pesqnome" placeholder="VENDEDOR" style="width:200px; height:30px; font-size:12px;" value="<?php echo $pesqnome ?>">
                        </div>
                        <div class="col">
                            <?php
                            $sqlp = 'select * from produto order by nome';
                            $result = mysqli_query($con, $sqlp);
                            if ($result) {
                                echo '<select class="form-control" name="comboproduto" style="width:170px; height:30px; font-size:12px;">';
                                echo '<option value="" selected>PRODUTO</option>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($comboproduto == $row['id']) {
                                        echo '<option value="' . $row['id'] . '"selected>' . $row['nome'] . '</option>';
                                    }
                                    echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                                }
                                echo '</select>';
                            }
                            ?>
                        </div>
                        <!-- combobox mes -->
                        <div class="col">
                            <select class="form-control" name="vlistames" style="width:100px; height:30px; font-size:12px;">
                                <?php
                                for ($i = 0; $i <= 12; $i++) {
                                    if ($vlistames == $i) {
                                        echo '<option value="' . $i . '" selected>' . $vmes[$i] . 'MES</option>';
                                    } else {
                                        echo '<option value="' . $i . '">' . $vmes[$i] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- combobox ano -->
                        <div class="col">
                            <select class="form-control" name="vlistaano" style="width:90px; height:30px; font-size:12px;">
                                <option value="0">ANO</option>
                                <?php
                                for ($i = 2000; $i <= 2030; $i++) {
                                    if ($vlistaano == $i) {
                                        echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                    } else {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- input ano de / ate -->
                        <div class="col">
                            <input type="date" name="datade" style="width:100px; height:30px; font-size:12px;" value="<?php echo "$datade" ?>">
                        </div>
                        <div class="col">
                            <input type="date" name="dataate" style="width:100px; height:30px; font-size:12px;" value="<?php echo "$dataate" ?>">
                        </div>
                        <div class="col">
                            <!-- botão responsável pelo submit para consulta parcial do Select -->
                            <button type="submit" name="submit" style=" height:30px; font-size:12px;" class="btn btn-primary">Consulta</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inicio da tabela de consulta -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">CodProd</th>
                        <th scope="col">Produto</th>
                        <th scope="col">CodVend</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col" class='text-center'> Quantidade</th>
                        <th scope="col" class='text-right'>Preço</th>
                        <th scope="col" class='text-right'>Total</th>
                        <th scope="col">DataVenda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Executa o SELECT para exibir dados na tabela
                    $result = mysqli_query($con, $sql);
                    $quant = 0;
                    $total = 0;
                    // Se retornou dados, monta a tabela por quantidade de registros.
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $idproduto = $row['idproduto'];
                            $idvendedor = $row['idvendedor'];
                            $datav = substr($row['datavenda'], 8, 2) .
                                substr($row['datavenda'], 4, 4) .
                                substr($row['datavenda'], 0, 4);
                            echo "<tr>
                           <td>" . $row['id'] . "</td>
                           <td>" . $row['idproduto'] . "</td>
                           <td>" . $row['produto'] . "</td>
                           <td>" . $row['idvendedor'] . "</td>
                           <td>" . $row['vendedor'] . "</td>
                           <td class='text-center'>" . $row['quantidade'] . "</td>
                           <td class='text-right'>" . number_format($row['preco'],2,',','.') . "</td>
                           <td class='text-right'>" . number_format($row['preco'] * $row['quantidade'],2,',','.'). "</td>
                           <td>" . $datav . "</td>";
                           $quant = $quant + $row['quantidade'];
                           $total = $total + $row['quantidade'] * $row['preco'];
                        //    acima, no ultimo td, sao gerados os botoes de altera e excluir,
                        }
                        echo "<tr><td></td> <td></td> <td></td> <td></td> <td>TOTAL:</td> <td class='text-center'>" .$quant. "</td> <td></td> <td class='text-right'>".number_format(($total),2,',','.'). "</td> <td></td>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</body>

</html>