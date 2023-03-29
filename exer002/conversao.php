<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="styles.css">
    <title>Conversão de Moedas</title>
</head>
<body>
    <main>
        <h1>Conversor de Moedas</h1>
    <?php 
     // Cotação vinda da API do banco Central
     $inicio=date("m-d-Y", strtotime("-7 days"));
    $fim=date("m-d-Y");
    $url='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    $dados=json_decode(file_get_contents($url),true);
    $cotacao=$dados["value"][0]["cotacaoCompra"];
        $real=$_GET["din"]??0;
        $dólar=$real/$cotacao;
        $padrão=numfmt_create("pt_BR",NumberFormatter::CURRENCY);
        echo "Seus ". numfmt_format_currency($padrão,$real,"BRL"). " equivalem a ".numfmt_format_currency($padrão,$dólar,"USD");
    
    ?>
    <button onclick="javascript:history.go(-1)">Voltar</button>

    </main>
</body>
</html>