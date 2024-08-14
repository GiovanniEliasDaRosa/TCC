<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
    <style>
        form{
            border: 1px solid;
            margin: 4px;
        }
    </style>
</head>
<body>
    <div><h1>Avisos</h1><a href="../index.php">Voltar</a></div>
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo '<meta charset="UTF-8">';
    include ('..\..\Conexao.php');
    $sql="SELECT titulo,id_aviso,corpo,dt_inicio,dt_fim FROM tb_aviso ORDER BY id_aviso DESC";
    $query=mysqli_query($con,$sql);
    while($ret=mysqli_fetch_array($query)){
        $date=date('Y-m-d');
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $id_aviso=$ret['id_aviso'];
        $dt_inicio=$ret['dt_inicio'];
        $dt_fim=$ret['dt_fim'];
        if($date<=$dt_fim){
            echo "<form action='edicao.php' method='post'>
                <p><input type='hidden' name='id_aviso' value='$id_aviso'></p>
                <p><label for='célula'>$titulo $dt_inicio
                <input type='submit' name='editar' value='editar'></label></p>
                </form>";
        }elseif($date>=$dt_fim){
            $delsql="DELETE FROM tb_aviso WHERE id_aviso=$id_aviso";
            $delquery=mysqli_query($con,$delsql) or die (mysqli_error($con));
        }else{}
        }
        echo "<table><td><a href='adicao.php'>Adicionar aviso</a></td></table>";
        
    mysqli_close($con)
    ?>
</body>
</html>