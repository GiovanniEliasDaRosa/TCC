<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Aviso</title>
</head>
<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        include_once('../../Conexao.php');
        $sql="SELECT * FROM tb_aviso WHERE id=$id";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $id=$ret['id'];
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $inicio=$ret['inicio'];
        $fim=$ret['fim'];
    }
    ?>
<body>
    <h1>Edição de Aviso</h1>
    <form method='post' action="confirmaredicao.php" enctype='multipart/form-data'>
        <p><input type="hidden" name="id" value="<?php echo $id;?>"></p>

        <p><label for="titulo">TíTulo</label>
        <input type="text" name="titulo" value="<?php echo $titulo;?>"></p>

        <p><label for="corpo">Corpo</label>
        <textarea type="text" name="corpo"><?php echo $corpo;?></textarea></p>

        <p><label for="inicio">Data da Postagem</label>
        <input type="date" name="inicio" value="<?php echo $inicio;?>"></p>

        <p><label for="fim">Data de Expiração</label>
        <input type="date" name="fim" value="<?php echo $fim;?>"></p>

        <p><input type="submit" name="salvar" value="salvar">
        <input type="button" value="voltar" onclick="history.back()">
        <button><a href='delecao.php?id=<?php echo $id;?>'>Excluir</a></button></p>
    </form>
    </div>
</body>
</html>