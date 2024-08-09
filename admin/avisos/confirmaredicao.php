<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando...</title>
</head>
<body>
    <?php
    if (isset($_POST['salvar'])){
        $id=$_POST['id'];
        $titulo=$_POST['titulo'];
        $corpo=$_POST['corpo'];
        $inicio=$_POST['inicio'];
        $fim=$_POST['fim'];
        include_once('../../Conexao.php');
        $sqlalt="UPDATE tb_aviso SET titulo='$titulo',corpo='$corpo',inicio='$inicio',fim='$fim' WHERE id='$id'";
        $query=mysqli_query($con,$sqlalt) or die (mysqli_error($con));
        mysqli_close($con);
        if($query){
            echo'Alteração efetuada com sucesso';
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=vizualizacao.php'>";
        }
    }
    ?>
</body>
</html>