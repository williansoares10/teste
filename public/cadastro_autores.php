<?php
require_once("../conexao/conexao.php"); 
?>

<?php
    
    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }
    
    if (isset($_POST["autor"])) {

        $autor = utf8_decode($_POST["autor"]);

        $created = date('Y-m-d H:i:s');

        $inserir  = "INSERT INTO autores ";
        $inserir .= "(autor, created) ";
        $inserir .= "VALUES ";
        $inserir .= "('$autor','$created')";

        $operacao_inserir = mysqli_query($conecta,$inserir);
        if(!$operacao_inserir){
            die("ERRO NO BANCO");
        }
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Autor</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       
        <link href="../css/estilo.css" rel="stylesheet">
        
        <script language="javascript">

            function valida_dados (autorform){
        
                if (autorform.autor.value==""){
                    alert ("Por favor informe o nome do Autor.");
                    return false;
                }

                return true;
            }        
        </script> 
    </head>
    <body>
        <?php include('home.php'); ?>
	    <div class="container content">
           
            <h4><center>Cadastro de Autor</center></h4>
            
            <form method="POST"  onSubmit="return valida_dados(this)">

                <div class="form-group">                  
                    <input type="autor" name="autor" class="form-control" id="autor" placeholder="Autor">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Cadastrar</button>

                    <a href="consulta.php" class="btn btn-primary">Consultar</a>
                </div>
            </form>    
        </div>
    </body>
</html>
<?php
    
    mysqli_close($conecta);

?>


