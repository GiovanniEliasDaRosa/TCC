<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Aviso</title>
</head>

<body>
<?php
    if(isset($_POST['editar'])){
        $id_aviso=$_POST['id_aviso'];
        include_once('../../Conexao.php');
        $sql="SELECT * FROM tb_aviso WHERE id_aviso=$id_aviso";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $titulo=$ret['titulo'];
        $corpo=$ret['corpo'];
        $dt_inicio=$ret['dt_inicio'];
        $dt_fim=$ret['dt_fim'];
        echo "<h1>Edição de Aviso</h1>
            <form method='post' action='edicao.php' enctype='multipart/form-data'>
                <p><input type='hidden' name='id_aviso' value='$id_aviso'></p>
        
                <p><label for='titulo'>Título</label>
                <input type='text' name='titulo' value='$titulo'></p>
        
                <p><label for='corpo'>Corpo</label>
                <textarea type='text' name='corpo'>$corpo</textarea></p>
        
                <p><label for='dt_inicio'>Data da Postagem</label>
                <input type='date' name='dt_inicio' value='$dt_inicio'></p>
        
                <p><label for='dt_fim'>Data de Expiração</label>
                <input type='date' name='dt_fim' value='$dt_fim'></p>
        
                <p><input type='submit' name='salvar' value='salvar'>
                <input type='button' value='voltar' onclick='history.back()'>
                <input type='submit' name='excluir' value='excluir'></p>
            </form>";
    }
    if (isset($_POST['salvar'])){
        $id_aviso=$_POST['id_aviso'];
        $titulo=$_POST['titulo'];
        $corpo=$_POST['corpo'];
        $dt_inicio=$_POST['dt_inicio'];
        $dt_fim=$_POST['dt_fim'];
        include_once('../../Conexao.php');
        $sqlalt="UPDATE tb_aviso SET titulo='$titulo',corpo='$corpo',dt_inicio='$dt_inicio',dt_fim='$dt_fim' WHERE id_aviso='$id_aviso'";
        $query=mysqli_query($con,$sqlalt) or die (mysqli_error($con));
        mysqli_close($con);
        if($query){
            echo'Alteração efetuada com sucesso';
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0.75;URL=vizualizacao.php'>";
        }
    }
    if (isset($_POST['excluir'])){
        $id_aviso=$_POST['id_aviso'];
        include_once('../../Conexao.php');
        $sql="SELECT titulo,dt_inicio,dt_fim FROM tb_aviso WHERE id_aviso=$id_aviso";
        $query=mysqli_query($con,$sql);
        $ret=mysqli_fetch_assoc($query);
        $titulo=$ret['titulo'];
        $dt_inicio=$ret['dt_inicio'];
        $dt_fim=$ret['dt_fim'];
        echo "<h1>Exclusão de aviso</h1>
        <form method='post' action='edicao.php' enctype='multipart/form-data'>

            <p>$titulo - postada em $dt_inicio com exclusão agendada para  $dt_fim</p>

            <input name='id_aviso' type='hidden' value='$id_aviso'>

            <p>tem certeza que deseja excluir o aviso selecionado antes do prazo de expiração?</p>

            <p><input type='submit' name='confirmar' value='Confirmar'/>
            <input type='button' value='Cancelar' onclick='history.back()'></p>
        </form>";
    }
    if (isset($_POST['confirmar'])){
        $id_aviso=$_POST['id_aviso'];
        include_once('../../Conexao.php');
        $sql="DELETE FROM tb_aviso WHERE id_aviso=$id_aviso";
        $query=mysqli_query($con,$sql) or die (mysqli_error($con));
        if($query){
            echo 'Aviso foi excluido com sucesso';
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0.75;URL=vizualizacao.php'";
        }
    }
    ?>
</body>
</html>