<?php

$conn = mysqli_connect('localhost', 'root', 'root', 'testeimg') or die ('Error connecting to database');

// Recebe o nome da imagem
$nome = intval($_GET['nomeIMG']);

// Requisição a ser feita no banco
$myquery = "SELECT `path` FROM imagens WHERE id=".$nome;

// executamos a query à base de dados e obtemos os valores
$result = mysqli_query($conn, $myquery) or die('MySQL Error:<br>'.mysql_error());
$row = mysqli_fetch_array($result);

// escrevemos o país de origem que solicitámos
echo utf8_encode($row['path']);
?>