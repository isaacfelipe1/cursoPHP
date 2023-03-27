<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Moedas</title>
</head>
<body>
    <main>
        <h1>Conversor de Moedas</h1>
    <?php 
        $cotação=5.17;
        $real=$_GET["din"]??0;
        $dólar=$real/$cotação;
        $padrão=numfmt_create("pt_BR",NumberFormatter::CURRENCY);
        echo "Seus". numfmt_format_currency($padrão,$real,"BRL"). "equivalem a".numfmt_format_currency($padrão,$dólar,"USD");
    
    ?>
    <button onclick="javascript:history.go(-1)">Voltar</button>

    </main>
</body>
</html>