<?php
session_start();
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="teste.php">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Vendas - Menu</title>
</head>


<body style="background-image: url('imagens/fundogestao.jpg');">


<div class="alert alert-primary" style="text-align: right;">
     
     Olá, <a href="caddisplay.php"> <?php echo $_SESSION['login']; ?>
 </a>
        <!-- Botão Menu para sair do sistema -->
        <button type="button" class="btn btn-primary">
            <a href="logout.php" style="color: white;">Sair</a></button>
        </a>
 </div>



    <div class="container">
        <div class="row">
            <div class="col text-center">
            <a href="proddisplay.php"> 
                <div class="circle">
                    <img src="imagens/produtos.jpg" alt=""> <br>
</div>
                    <h4 style="color: white;">Produtos</h4></a>
                    
            </div>
            <div class="col text-center">
                <a href="venddisplay.php">
                <div class="circle">
                    <img src="imagens/vendedor.jpg" alt=""> <br>
                </div>
                    <h4 style="color: white;">Vendedores</h4></a>
            </div>
            <div class="col text-center">
                <a href="vsdisplay.php"> 
                <div class="circle">
                <img src="imagens/vendas.jpg" alt=""> <br>
                </div>
                <h4 style="color: white;">Vendas</h4></a>
            </div>
            <div class="col text-center">
                <a href="consdisplay.php"> 
                <div class="circle">
                <img src="imagens/consultas.jpg" alt=""> <br>
                </div>
               <h4 style="color: white;"> Consultas</h4></a>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
    </div>
</body>

</html>