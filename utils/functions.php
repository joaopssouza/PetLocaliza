<?php
/*
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
*/

function carregarDados($arquivo) {
  return file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : [];
}

function salvarDados($arquivo, $dados) {
  file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function listarUnicos($dados, $chave) {
  return array_unique(array_map(fn($item) => $item[$chave], $dados));
}
?>
