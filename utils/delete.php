<!--
   Copyright 2025 João Paulo Santos Souza

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License. 
-->

<?php
// Inclui o arquivo com funções auxiliares, como carregar e salvar dados em JSON
require_once 'functions.php';

// Verifica se a requisição é POST e se foi enviado um código de exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_exclusao'])) {
    
    // Captura e formata o código informado (remove espaços e deixa em maiúsculo)
    $codigo = strtoupper(trim($_POST['codigo_exclusao']));
    
    // Carrega os dados existentes do arquivo JSON
    $dados = carregarDados('../data/datas.json');
    
    // Flag que indica se o código foi encontrado
    $encontrado = false;

    // Filtra os dados, removendo o item com o código correspondente
    $dadosFiltrados = array_filter($dados, function($item) use ($codigo, &$encontrado) {

        // Verifica se o item possui o campo 'codigo_exclusao' e se é igual ao informado
        if (isset($item['codigo_exclusao']) && strtoupper($item['codigo_exclusao']) === $codigo) {
            $encontrado = true; // Marca como encontrado

            // Se o item tiver uma imagem e ela existir fisicamente no servidor...
            if (!empty($item['imagem'])) {
                $caminhoImagem = $item['imagem'];

                // Verifica se o arquivo existe
                if (file_exists($caminhoImagem)) {

                    // Tenta excluir a imagem do servidor
                    if (!unlink($caminhoImagem)) {
                        // Se não conseguir excluir, registra no log de erro
                        error_log("Erro ao excluir imagem: $caminhoImagem");
                    }

                } else {
                    // Se o arquivo não existir, registra no log
                    error_log("Imagem não encontrada: $caminhoImagem");
                }
            }

            // Retorna false para remover esse item da lista
            return false;
        }

        // Caso contrário, mantém o item
        return true;
    });

    // Se o item com o código foi encontrado...
    if ($encontrado) {
        // Reorganiza os índices do array filtrado e salva novamente no arquivo JSON
        salvarDados('../data/datas.json', array_values($dadosFiltrados));

        // Exibe mensagem de sucesso e redireciona para a página principal
        echo "<script>alert('Cadastro excluído com sucesso!'); window.location.href = '../index.php';</script>";
    } else {
        // Se o código não for encontrado, mostra alerta e redireciona
        echo "<script>alert('Código não encontrado. Verifique e tente novamente.'); window.location.href = '../index.php';</script>";
    }

} else {
    // Se não for uma requisição POST válida, redireciona para a página principal
    header("Location: ../index.php");
    exit;
}
?>
