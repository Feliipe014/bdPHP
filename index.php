<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
</head>
<body>
    
<?php
    $pdo = new PDO('mysql:host=localhost;dbname=first_bd','root');

    if(isset($_POST['acao'])){
        $nome = strip_tags($_POST['nome']);
        $link = strip_tags($_POST['link']);

        $sql = $pdo->prepare("INSERT INTO `tb.aulas` VALUES (null,?,?)");

        if($sql->execute(array($nome,$link))){
            echo '<script>alert("INSERIDO COM SUCESSO")</script>';
        }else{
            die("Falhou");
        }
    }

    $sql = $pdo->prepare("SELECT * FROM `tb.aulas`");
    $sql->execute();
    $aulas = $sql->fetchAll();

    foreach ($aulas as $key => $value) {
        echo '<h2>'.$value['nome'].'</h2>';
        echo '<br/>';
        echo '<iframe width="400" height="400" src"'.$value['link_aula'].'"></iframe>';
        echo '<hr>';
    }
?>

<form method="post">
    <input type="text" name="nome" placeholder="nome do seu video...">
    <input type="text" name="link" placeholder="link do seu video...">
    <input type="submit" name="acao" value="Cadastrar!">

</form>

</body>
</html>