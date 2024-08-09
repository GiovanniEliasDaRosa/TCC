<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluindo...</title>
</head>
<body>
    <?php
    if (isset($_POST['excluir'])){
        $id=$_POST['id'];
        include_once('../../Conexao.php');
        $sql="DELETE FROM tb_aviso WHERE id=$id";
        $query=mysqli_query($con,$sql) or die (mysqli_error($con));
        if($query){
            echo 'Aviso foi excluido com sucesso';
            echo "<meta HTTP-EQUIV='refresh' CONTENT='2;URL=vizualizacao.php'";
        }
    }
    ?>
</body>
</html>