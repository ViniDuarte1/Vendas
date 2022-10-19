<?php
// Conexão ao banco de dados
  // localhost
  // senha no notebook: senac123
//  $con= new mysqli('mysql35-farm2.uni5.net','curtaaulacurta02','senac123','curtaaulacurta02');
  $con= new mysqli('localhost','root','','vendas');
  if (!$con) {
     die(mysqli_error($con));
  } 
?>
