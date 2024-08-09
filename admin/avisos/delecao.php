<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Aviso</title>
</head>
<body>
    <?php
    if (isset($_GET['id'])){
        $id=$_GET['id'];
        include_once('../../Conexao.php');
        $sql="SELECT titulo,inicio,fim FROM tb_aviso WHERE id=$id";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $titulo=$ret['titulo'];
        $inicio=$ret['inicio'];
        $fim=$ret['fim'];
    }
    ?>
    <h1>Exclusão de aviso</h1>
    <form method="POST" action="confirmardelecao.php" enctype="multipart/form-data">

        <?php echo "$titulo - postada em $inicio com exclusão agendada para  $fim";?>

        <input name="id" type="hidden" value="<?php echo $id;?>" type="text">

        <p>tem certeza que deseja excluir o aviso selecionado antes do prazo de expiração?</p>

        <p><input type="submit" name="excluir" value="Excluir"/>
        <input type="button" value="Cancelar" onclick="history.back()"></p>
    </form>
</body>
</html>