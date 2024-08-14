<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ler mais</title>
</head>
<body>
    <?php
    if(isset($_GET['id_aviso'])){
        $id_aviso=$_GET['id_aviso'];
        include_once('../Conexao.php');
        $sql="SELECT * FROM tb_aviso WHERE id_aviso=$id_aviso";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $dt_inicio=$ret['dt_inicio'];
        $dt_fim=$ret['dt_fim'];
        echo "<h1>$titulo</h1><p>$dt_inicio até $dt_fim</p><br>
        <p>$corpo</p>";
        echo "<input type='button' value='Voltar' onclick='history.back()'>";
    }
    ?>
</body>
</html>