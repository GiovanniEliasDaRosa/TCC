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
    <h1>Avisos <a href="cronograma.php">Cronograma</a></h1>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo '<meta charset="UTF-8">';
    include ('..\Conexao.php');
    $sql="SELECT titulo,id_aviso,corpo,dt_inicio,dt_fim FROM tb_aviso ORDER BY dt_inicio DESC";
    $query=mysqli_query($con,$sql);
    while($ret=mysqli_fetch_array($query)){
        $date=date('Y-m-d');
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $id_aviso=$ret['id_aviso'];
        $dt_inicio=$ret['dt_inicio'];
        $dt_fim=$ret['dt_fim'];
        if($date>=$dt_inicio && $date<=$dt_fim){
            echo "<table> <tr> <th>$titulo $dt_inicio</th>";
            if($corpo!=null){
                echo "<th><a href='lermais.php?id_aviso=$id_aviso'>Ler Mais</a></th></tr></table>";
            }else{
                echo "</tr></table>";}
        }elseif($date>=$dt_fim){
            include_once('../../Conexao.php');
            $delsql="DELETE FROM tb_aviso WHERE id_aviso=$id_aviso";
            $delquery=mysqli_query($con,$delsql) or die (mysqli_error($con));
        }else{}
      }
    mysqli_close($con)
    ?>
</body>
</html>