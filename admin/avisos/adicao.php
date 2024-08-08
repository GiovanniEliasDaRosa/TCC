<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Aviso</title>
    <?php
    function futuro($dias){
    $date = date_create(date('Y-m-d'));
    date_add($date, date_interval_create_from_date_string("$dias days"));
    echo date_format($date, "Y-m-d");}
    ?>
</head>
<body>

    <form method="post" action="AddAviso.php" enctype="multipart/form-data">

        <h1>Adicionar Aviso</h1>

        <p><label for="titulo">Título</label>
        <input type="text" name="titulo" required/></p>

        <p><label for="corpo">Corpo</label>
        <textarea name="corpo"></textarea></p>

        <p><label for="inicio">Data da Postagem</label>
        <input type="date" name="inicio" value="<?php $data=date('Y-m-d'); echo $data;?>" required></p>

        <p><label for="fim">Data de expiração</label>
        <input type="date" name="fim" value="<?php echo futuro(7);?>"required></p>

        <p><input type="submit" name="Enviar">
        <button><a href="vizualizacao.php">Voltar</a></button></p>

    </form>
    <?php
        if(isset($_POST['Enviar'])){
            $titulo=$_POST['titulo'];
            $corpo=$_POST['corpo'];
            $inicio=$_POST['inicio'];
            $fim=$_POST['fim'];
            include('../Conexao.php');
            $sql="INSERT INTO tb_aviso(titulo,corpo,inicio,fim) VALUES('$titulo','$corpo','$inicio','$fim')";
            $query=mysqli_query($con,$sql);
            echo "Aviso adicionado";
        }
    ?>
</body>

</html>