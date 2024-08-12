<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
    <style>
        table,th{
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
        if($date>=$inicio && $date<=$fim){
            echo "<table> <tr> <th>$titulo $inicio</th>";
            if($corpo!=null){
                echo "<th><a href='lermais.php?id=$id'>Ler Mais</a></th></tr></table>";
            }else{
                echo "</tr></table>";}
        }elseif($date>=$fim){
            include_once('../../Conexao.php');
            $delsql="DELETE FROM tb_aviso WHERE id=$id";
            $delquery=mysqli_query($con,$delsql) or die (mysqli_error($con));
        }else{}
      }
    mysqli_close($con)
    ?>
</body>
</html>