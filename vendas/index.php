<?php
session_start();
?>
<!DOCTYPE html>
<html>
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intermitente - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
 
<body style="background-image: url('imagens/fundogestao.jpg');">
    <div class="container" style="margin-top: 170px; width:330px;">
        <div class="row">
            <div class="col" style="border-radius: 15px; border-color: orange;">
                <div class="jumbotron" style="width: 300px; margin-left: 3px; margin-top: 15px;">
                    <div class="alert alert-info"><strong> login </strong></div>
                    <?php
                    if (isset($_SESSION['nao_autenticado'])) :
                    ?>
                        <div class="alert alert-danger text-center">
                            <p>ERRO <br> Usuário ou senha inválidos.</p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
                    <form action="login.php" method="POST">
                        <input name="login" type="text" class="form-control" placeholder="Seu usuário" autofocus="">
                        <input name="senha" class="form-control" type="password" placeholder="Sua senha">
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary botaotam" style="width: 235px;">Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
