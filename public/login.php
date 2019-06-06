<?php
require_once("../conexao/conexao.php"); 
?>
<?php

    //add variavel de sessao
    session_start();

    if(isset($_POST["usuario"])){
        $usuario =$_POST["usuario"];
        $senha   =$_POST["senha"];

        $log  =  "SELECT * ";
        $log .=  "FROM login ";
        $log .=  "WHERE usuario = '{$usuario}'and senha ='{$senha}' ";

        $acesso = mysqli_query($conecta, $log);
        if(!$acesso){
            die("Falha na consulta ao banco");
        }

        $informacao = mysqli_fetch_assoc($acesso);
        if(empty($informacao)){
            $mensagem = "Login sem sucesso";
        }else{//abre variavel de secao
            $_SESSION["user_portal"]=$informacao["usuarioID"];
            header("location:consulta.php");
           }
        }    
?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Login</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <link href="../css/estilo.css" rel="stylesheet">

    <head>      
    </head>
    <body>
    	<div class="container content">
        	<h4><center>Login</center></h4>
            <form action="login.php" method="POST">

                <div class="form-group">                  
                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                </div>
                <div class="form-group">
                    <center><button class="btn btn-primary">Entrar</button></center>
                </div>

                <?php
                    if(isset($mensagem)){
                ?>

                    <p><?php echo $mensagem ?></p>


                <?php } ?>    
            </form>
        </div>
    </body>
</html>



