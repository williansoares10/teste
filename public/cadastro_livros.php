<?php
require_once("../conexao/conexao.php"); 
?>

<?php

    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }

    $tr = "SELECT autor, id FROM autores";
    $consulta_autor = mysqli_query($conecta, $tr);
    if(!$consulta_autor) {
        die("erro no banco");
    }

    $row = "SELECT descricao, id FROM generos";
    $consulta_genero = mysqli_query($conecta, $row);
    if(!$consulta_genero) {
        die("erro no banco");
    }

    
    if(isset($_POST["titulo"])){

        $titulo        = utf8_decode($_POST["titulo"]);
        $quantidade    = $_POST["quantidade"];
        $isbn          = $_POST["isbn"];
        $descricao     = utf8_decode($_POST["descricao"]);
        $autor         = $_POST["autor"];
        $genero       = $_POST["genero"];

        $created = date('Y-m-d H:i:s');
        $modified = date('Y-m-d H:i:s');
       
        $inserir  = "INSERT INTO livros ";
        $inserir .= "(titulo, quantidade, isbn, descricao, autor_id, genero_id, created, modified) ";
        $inserir .= "VALUES ";
        $inserir .= "('$titulo','$quantidade','$isbn','$descricao', $autor, $genero, '$created','$modified')"; 

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
        <title>Livros</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
       
        <link href="../css/estilo.css" rel="stylesheet">
        
        <script language="javascript">

            function valida_dados (nomeform){
        
                if (nomeform.titulo.value==""){
                    alert ("Por favor informe o titulo do livro.");
                    return false;
                }

                if (nomeform.quantidade.value==""){
                    alert ("Por favor informe a quantidade.");
                    return false;
                }

                if (nomeform.isbn.value==""){
                    alert ("Por favor informe o isbn.");
                    return false;
                }

                if (nomeform.descricao.value==""){
                    alert ("Por favor informe a descrição.");
                    return false;
                }

                if (nomeform.autor.value==""){
                    alert ("Por favor selecione um autor.");
                    return false;
                }

                if (nomeform.genero.value==""){
                    alert ("Por favor selecione um gênero.");
                    return false;
                }
                
                return true;
            }        
        </script> 
    </head>
    <body>
        <?php include('home.php'); ?>
	    <div class="container content">
          
            <h4><center>Cadastro de Livros</center></h4>            
        
            <form method="POST"  onSubmit="return valida_dados(this)">

                <div class="form-group">                  
                    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título">
                </div>

                <div class="form-group">
                    <input type="number" name="quantidade" class="form-control" id="quantidade" placeholder="Quantidade">
                </div>

                <div class="form-group">
                    <input type="text" name="isbn" class="form-control" id="isbn" placeholder="ISBN">
                </div>

                <div class="form-group">
                    <textarea class="form-control" rows="5" id="descricao" name="descricao" placeholder="Descrição..."></textarea>
                </div>

                <div class="form-group">
                    <label for="autor">Autores:</label>
                        <select class="form-control" id="autor" name="autor" >
                            <option value=""></option>

                                <?php
                                    while($linha = mysqli_fetch_assoc($consulta_autor)){
                                ?>
                                <option value="<?php echo $linha["id"] ?>">
                            
                                <?php 
                                    echo utf8_encode ($linha["autor"]);  
                                ?>  

                                </option>
                                 
                                <?php 
                                    } 
                                ?>                           
                        </select>
                </div>
                <div class="form-group">
                    <label for="genero">Gêneros:</label>
                        <select class="form-control" id="genero" name="genero">
                            <option value=""></option>
                                <?php
                                    while($linha = mysqli_fetch_assoc($consulta_genero)){
                                ?>
                                    <option value="<?php echo $linha["id"] ?>">
                                
                                <?php 
                                    echo utf8_encode ($linha["descricao"]);  
                                ?>  

                                </option>
                                 
                                <?php 
                                    } 
                                ?>          
                        </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Cadastrar</button>

                    <a href="consulta.php" class="btn btn-primary">Consultar</a>
  
                    <a href="sair.php" class="btn btn-danger">Logoff</a>
                </div>
            </form>      
        </div>       
    </body>
</html>
<?php
    mysqli_close($conecta);
?>