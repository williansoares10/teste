<?php
    require_once("../conexao/conexao.php"); 
?>

<?php
    
    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }

    if(isset($_GET["id"])) {
        $livro_id = $_GET["id"];
    } else if (isset($_POST["id"])) {
        $livro_id = $_POST["id"];
    } else {
        header("location:consulta.php"); 
    }

    $query = "SELECT titulo, quantidade FROM livros WHERE id = ".$livro_id;

    $con_livros = mysqli_query($conecta, $query);
    if(!$con_livros) {
        die("Erro na consulta dos dados");
    } else {
        $info_locacao = mysqli_fetch_assoc($con_livros);

    }

    if(isset($_POST["quantidade"])) { 

        $quantidade = $_POST["quantidade"];
        $modified = date('Y-m-d H:i:s');
   
        $alterar = "UPDATE livros SET quantidade='$quantidade', modified='$modified' WHERE id=$livro_id ";
        $operacao_alterar = mysqli_query($conecta, $alterar); 
            if(!$operacao_alterar){
                die("Erro na alteração");
        }  else{
            header("location:consulta.php");
        }
    }

?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Locação</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       
        <link href="../css/estilo.css" rel="stylesheet">
        
        <script language="javascript">

            function valida_dados (locarform){
        
                if (locarform.quantidade.value==""){
                    alert ("Por favor informe a quantidade de livros");
                    return false;
                }

                return true;
            }        
        </script> 
    </head>
    <body>
        <?php include('home.php'); ?>
        <div class="container content">
           
            <h4><center>Locação de Livros</center></h4><p>
            
            <form method="POST"  onSubmit="return valida_dados(this)">

                <div class="form-group">   
                    <label for="form-control">Título selecionado:</label>               
                    <input type="text" value="<?php echo utf8_encode($info_locacao["titulo"])?>" name="titulo" class="form-control" id="titulo" placeholder="Título" readonly>
                </div>
                <p>
                <div class="form-group">
                    <label for="form-control">Quantidade:</label>                  
                    <input type="number" value="<?php echo utf8_encode($info_locacao["quantidade"])?>" name="quantidade" class="form-control" id="quantidade" placeholder="Quantidade">
                </div>

                <p><input type="hidden" name="id" value="<?php echo $info_locacao["id"]?>"></p>

                <div class="form-group">
                    <button class="btn btn-primary">Editar</button>
                </div>

                <div class="form-group">
                    <a href="consulta.php" class="btn btn-primary">Voltar</a>
                </div>
            </form>    
        </div>
    </body>
</html>
<?php  
    mysqli_close($conecta);

?>
