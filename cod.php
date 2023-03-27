<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <?php 
        $nome=$_GET["nome"] ?? "sem nome";
        $sobrenome=$_GET["sobrenome"] ?? "sem sobrenome";
        echo "<p> É um prazer te conhecer <strong>" .$nome. " ". $sobrenome. "</strong>! Este é meu site </p>";
    ?>
    <p> <a href="javascript:history.go(-1)">Voltar para a página Principal</a></p>
</body>
</html>