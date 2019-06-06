<?php
    require_once("../conexao/conexao.php"); 
?>

<?php

    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }

    if(isset($_GET["id"])){
        $cID = $_GET["id"];
    } else {
        die("Não foi enviado nenhum ID"); 
    }

    $excluir   = "DELETE FROM livros "; 
    $excluir  .= "WHERE id = ". $cID; 

    

    $con_excluir = mysqli_query($conecta, $excluir); 
    
    if (!$con_excluir){ 
        die("Registro não excluído");
    }else{ 
         header("location:consulta.php");
    }


?>

<?php
   
    mysqli_close($conecta);

?>

