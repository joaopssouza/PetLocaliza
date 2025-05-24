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
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
  $dados = $_POST;
  $dados['descricao'] = substr($_POST['descricao'], 0, 110);
  $dados['id'] = uniqid('pet_');
  $dados['cidade'] = $_POST['cidade'];
  $dados['bairro']= $_POST['bairro'];
  $dados['nome']= $_POST['nome'];

  $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
  $nomeImagem = uniqid('pet_', true) . '.' . $ext;
  $caminhoDestino = '../img/pictures/' . $nomeImagem;

  if ($_FILES['foto']['size'] > 5 * 1024 * 1024) {
    header("Location: ../index.php?error=imagem_grande");
    exit;
  }

  if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoDestino)) {
    die("Erro ao mover a imagem.");
  }

	$dados['imagem'] = $caminhoDestino;

	$dados['codigo_exclusao'] = strtoupper(substr(md5(uniqid()), 0, 6));

	$lista = carregarDados('../data/datas.json');
	$lista[] = $dados;
	salvarDados('../data/datas.json', $lista);

	header("Location: ../index.php?codigo=" . $dados['codigo_exclusao']);
	exit;

}
?>
