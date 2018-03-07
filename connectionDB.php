<?php

function connectTo($pw) {
    //abrimos a ligação à nossa base de dados e escolhemos a tabela
    $conn = mysqli_connect('localhost', 'root', $pw, 'testeimg') or die ('Error connecting to database');
}

?>