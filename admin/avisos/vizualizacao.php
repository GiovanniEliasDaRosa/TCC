<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
</head>
<body>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo '<meta charset="UTF-8">';
    include ('..\..\Conexao.php');
    $sql="SELECT titulo,id,corpo,inicio,fim FROM tb_aviso ORDER BY id DESC";
    $query=mysqli_query($con,$sql);
    while($ret=mysqli_fetch_array($query)){
        $date=date('Y-m-d');
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $id=$ret['id'];
        $inicio=$ret['inicio'];
        $fim=$ret['fim'];
        if($date<=$fim){
            echo "<form action='edicao.php' method='post'>
                <p><input type='hidden' name='id' value='$id'></p>
                <p><label for='célula'>$titulo $inicio
                <input type='submit' name='editar' value='editar'></label></p>
                </form>";
        }elseif($date>=$fim){
            $delsql="DELETE FROM tb_aviso WHERE id=$id";
            $delquery=mysqli_query($con,$delsql) or die (mysqli_error($con));
        }else{}
        }
        echo "<table><td><a href='adicao.php'>Adicionar aviso</a></td></table>";
        
    mysqli_close($con)
    ?>
</body>
</html>