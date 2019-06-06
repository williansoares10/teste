<?php

date_default_timezone_set("America/Sao_Paulo");

//Abrir conexão
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "biblioteca";
$conecta = mysqli_connect($servidor,$usuario,$senha,$banco);

//Testar conexão

if (mysqli_connect_errno()){
	die("conexão falhou: " . mysqli_connect_errno());
}



?>