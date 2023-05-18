<?php

// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "orcamento";

// Cria a conexão com o banco de dados
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão com o banco de dados
if (!$conn) {
   die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

?>