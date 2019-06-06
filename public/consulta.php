<?php
require_once("../conexao/conexao.php"); 
?>
<?php

    session_start();

    if (!isset($_SESSION["user_portal"])){
        header("location:login.php");
    }
    

    $tr = "SELECT liv.id, aut.autor, liv.titulo, liv.quantidade, liv.isbn, liv.descricao, gen.descricao as genero FROM livros liv INNER JOIN autores aut ON aut.id = liv.autor_id INNER JOIN generos gen ON gen.id = liv.genero_id";
       

    if(isset($_GET["pesquisar"])){
        $nome_titulo = $_GET["pesquisar"];
        $tr .= " WHERE liv.titulo LIKE '%". $nome_titulo ."%' ";
   

    }
    $consulta_tr = mysqli_query($conecta, $tr);
    if(!$consulta_tr) {
        die("erro no banco");
    }
?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Consulta</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

       <style type="text/css" media="screen">
           .wrapDescricao {
                overflow-x: hidden;
                overflow-y: auto;
                max-height: 100px;
           }
       </style>
    </head>
    <body>
        <?php include('home.php'); ?>
        <div class="container">

            <form action="consulta.php" method="get">
                <div class="form-group" id="pesquisar">
                    <input type="text" name="pesquisar" size="30" placeholder="Pesquise o nome do livro">
                    <button class="btn btn-secondary" type="submit"> Pesquisar </button>
                    <a href="sair.php" class="btn btn-danger">Logoff</a>
                </div>    
            </form>

            <h4><center>Consulta</center></h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">ISBN</th>
                        <th scope="col" width="max-width:50px">Descrição</th></div>
                        <th scope="col">Disponivel</th>
                        <th scope="col" width="160">Opções</th>
                    </tr>
                  </thead>
                <tbody>
                <?php
                    while($linha = mysqli_fetch_assoc($consulta_tr)){
                        $locar = "locar.php?id=".$linha["id"];
                        $excluir = "excluir.php?id=".$linha["id"];
                ?>
                <tr>
                    <th scope="row"><?php echo utf8_encode($linha["id"])  ?></th>
                    <td><?php echo utf8_encode($linha["titulo"])  ?></td>
                    <td><?php echo utf8_encode($linha["autor"]) ?></td>
                    <td><?php echo utf8_encode($linha["genero"]) ?></td>
                    <td><?php echo utf8_encode($linha["quantidade"]) ?></td>
                    <td><?php echo utf8_encode($linha["isbn"]) ?></td>
                    <td><div class="wrapDescricao"><?php echo utf8_encode($linha["descricao"]) ?></div></td>
                    <td><?php echo ($linha["quantidade"] > 0 ? 'Sim' : 'Não') ?></td>
                    
                    <td>
                        <a href="<?php echo $locar ?>"><button type="button" class="btn btn-outline-success">Editar</button>
                        <a href="<?php echo $excluir ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?')"><button type="button" class="btn btn-outline-danger">X</button>
                        
                </tr> 

                <?php 
                    }
                 ?> 
                </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php
    mysqli_close($conecta);

?>


