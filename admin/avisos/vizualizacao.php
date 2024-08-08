<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
    <style>
        tr,td{
            border: 1px solid;
            margin: 4px;
        }
    </style>
</head>
<body>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo '<meta charset="UTF-8">';
    include ('..\Conexao.php');
    $sql="SELECT titulo,id,corpo,inicio,fim FROM tb_aviso ORDER BY inicio DESC";
    $query=mysqli_query($con,$sql);
    while($ret=mysqli_fetch_array($query)){
        $date=date('Y-m-d');
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $id=$ret['id'];
        $inicio=$ret['inicio'];
        $fim=$ret['fim'];
        if($date>=$dia && $date<=$exp){
            echo "<table> <tr> <td>$titulo $inicio</td><td><a href='EditAviso.php?id=$id'>Editar</a> ";
            if($corpo!=null){
                echo "<td><a href='MaisAviso.php?id=$id'>Ler Mais</a></td></tr></table>";
            }else{
                echo "</tr></table>";}
        }elseif($date>=$exp){
            include_once('../Conexao.php');
            $delsql="DELETE FROM tb_aviso WHERE id=$id";
            $delquery=mysqli_query($con,$delsql) or die (mysqli_error($con));
        }else{}
        }
        echo "<table><tr><td><a href='AddAviso.php'>Adicionar aviso</a></td></tr></table>";
    mysqli_close($con)
    ?>
</body>
</html>