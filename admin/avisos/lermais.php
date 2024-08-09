<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ler mais</title>
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        include_once('../../Conexao.php');
        $sql="SELECT * FROM tb_aviso WHERE id=$id";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $inicio=$ret['inicio'];
        $fim=$ret['fim'];
        echo "<h1>$titulo</h1><p>$inicio até $fim</p><br>
        <p>$corpo</p>";
        echo "<input type='button' value='Voltar' onclick='history.back()'>";
    }
    ?>
</body>
</html>