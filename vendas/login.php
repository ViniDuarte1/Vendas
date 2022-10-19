<?php
session_start();
include('connect.php');
// so vai executar o login se houver usuario e senha digitados
if(empty($_POST['login']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}
// a funcao abaixo é para proteger o acesso
$login = mysqli_real_escape_string($con, $_POST['login']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);
$query = "select login from usuario where login = '{$login}' and senha = '{$senha}'";
// executa a query
$result = mysqli_query($con, $query);
echo $query;
// numero de linhas retornadas
$row = mysqli_num_rows($result);
// se tem uma linha, ok. senao não tem o usuario
if($row == 1) {
    $_SESSION['login'] = $login;
    header('Location: menu.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>
