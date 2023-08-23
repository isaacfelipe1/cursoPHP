<?php
if (isset($_POST['acao'])) {
    $arquivo = $_FILES['file'];
    $nomeArquivo = basename($arquivo['name']);
    $caminhoCompleto = 'uploads/' . $nomeArquivo;

    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
        $zip = new ZipArchive();

        // Abrir Arquivo Zip
        if ($zip->open($caminhoCompleto) === TRUE) {
            // Criar uma pasta temporária para extrair os arquivos
            $tempDir = 'uploads/' . pathinfo($nomeArquivo, PATHINFO_FILENAME);
            
            if (!is_dir($tempDir)) {
                mkdir($tempDir);
            }

            // Extrair os arquivos
            if ($zip->extractTo($tempDir) === TRUE) {
                $zip->close();

                $dados = array();

                // Função recursiva para percorrer subdiretórios
                function percorrerDiretorio($dir) {
                    global $dados;

                    $imagens = glob("$dir/*.{jpg,png}", GLOB_BRACE);

                    foreach ($imagens as $imagemPath) {
                        list($largura, $altura) = getimagesize($imagemPath);
                        $dados[] = array(
                            "nome" => str_replace($dir . '/', '', $imagemPath),
                            "largura" => $largura,
                            "altura" => $altura,
                        );
                    }

                    $subdiretorios = glob("$dir/*", GLOB_ONLYDIR);

                    foreach ($subdiretorios as $subdir) {
                        percorrerDiretorio($subdir);
                    }
                }

                percorrerDiretorio($tempDir);

                $json = json_encode($dados);
                header('Content-Type: application/json');
                echo $json;

                // Remover a pasta temporária e seus conteúdos
                function removerDiretorio($dir) {
                    $files = glob($dir . '/*');
                    foreach ($files as $file) {
                        is_dir($file) ? removerDiretorio($file) : unlink($file);
                    }
                    rmdir($dir);
                }

                removerDiretorio($tempDir);
            } else {
                echo "Erro ao extrair o arquivo ZIP.";
            }
        } else {
            echo "Erro ao abrir o arquivo ZIP.";
        }
    } else {
        echo "Erro ao fazer o upload do arquivo.";
    }
}
?>
