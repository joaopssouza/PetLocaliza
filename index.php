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
date_default_timezone_set("America/Sao_Paulo");
require_once 'utils/functions.php';

$dados = carregarDados('data/datas.json');

$tipos = listarUnicos($dados, 'tipo');
$bairros = listarUnicos($dados, 'bairro');
$cidades = listarUnicos($dados, 'cidade');
$statuss = listarUnicos($dados, 'status');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>PetLocaliza</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="imagex/png" href="./img/icons/icon-192.png">
  <link rel="manifest" href="/manifest.json" />
  <meta name="theme-color" content="#4CAF50" />
  <script src="js/script.js"></script>
  <script src="js/cep.js"></script>
</head>
<body>
  <header class="top-header">
    <div class="logo">🐾 <strong>PetLocaliza</strong></div>
    <nav class="nav-links">
      <a href="https://wa.me/5531000000000" target="_blank">Contato</a>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h1>PetLocaliza</h1>
      <p>Ajude a encontrar animais perdidos na sua cidade!</p>
      <div class="hero-buttons">
        <button class="btn-orange" onclick="toggleForm('Desaparecido')">Perdi um pet</button>
        <button class="btn-green" onclick="toggleForm('Encontrado')">Lista de pets</button>
        <button class="btn-red" onclick="mostrarFormularioExclusao()">Excluir cadastro</button>
      </div>

      <div class="codigo-exclusao" id="formExclusao" style="display: none;">
          <h3>Excluir cadastro de animal</h3>
          <p>Digite o código de exclusão fornecido no cadastro:</p>
          <form action="utils/delete.php" method="POST" onsubmit="return confirmarExclusao()">
            <input type="text" name="codigo_exclusao" placeholder="Digite o código" required>
            <button type="submit" class="btn-red">Excluir Cadastro</button>
          </form>
      </div>
      <div id="form-section" class="formulario" >
          <h2>Cadastre um animal</h2>
          <form action="utils/save.php" method="POST" enctype="multipart/form-data" onsubmit="return enviarFormulario()">
            <input type="text" name="nome" placeholder="Nome do pet" maxlength="40" onblur="semnome(this.value);">
            <input type="text" name="tipo" placeholder="Espécie" maxlength="15" required>
            <input type="text" name="cor" placeholder="Cor do pet" maxlength="15" required>
            <input name="cep" type="text" id="cep" value="" maxlength="10" maxlength="9"
            onblur="pesquisacep(this.value);" placeholder="Seu CEP" required />
            <input type="hidden" name="cidade" id="cidade" placeholder="Cidade" required>
            <input type="hidden" name="bairro" id="bairro" placeholder="Bairro" required>
            <input type="hidden" name="data" value="<?= date("d/m/Y H:i:s") ?>">
            <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required>
            <div class="form-group">
              <label for="descricao"></label>
              <textarea id="descricao" name="descricao" maxlength="110" rows="3" placeholder="Descrição (opcional) Ex: Muito dócil, atende por 'Kiara'..." class="form-control"></textarea>
            </div>
            <div class="radio-group">
              <label><input type="radio" name="status" value="Desaparecido" required> Desaparecido</label>
              <label><input type="radio" name="status" value="Encontrado"> Encontrado</label>
            </div>
            <input type="file" name="foto" accept="image/*" required>
            <button type="submit">Cadastrar</button>

            <?php if (isset($_GET['error']) && $_GET['error'] === 'imagem_grande'): ?>
              <script>
                alert("ERRO: A imagem deve ter no máximo 5MB.");
              </script>
              <?php endif; ?>

              <?php if (isset($_GET['codigo']) && !isset($_GET['error'])): ?>
              <script>
                alert("Cadastro realizado com sucesso! Seu código de exclusão é: <?= htmlspecialchars($_GET['codigo'], ENT_QUOTES) ?>");
              </script>
              <?php endif; ?>

          </form>
      </div>
    </section>

    <section class="listagem" id="listagem">
	  <h2>🚨 LISTA DE PETS 🚨</h2>
      <div class="filtros">
        <select onchange="filtrar()" id="filtro-status">
          <option value="" disabled selected>Filtrar o status...</option>
          <option value="">Todos</option>
          <?php foreach ($statuss as $status): ?>
            <option value="<?= $status ?>"><?= $status?></option>
          <?php endforeach; ?>
        </select>
        <select onchange="filtrar()" id="filtro-bairro">
          <option value="" disabled selected>Filtrar por bairro...</option>
          <option value="">Todos</option>
          <?php foreach ($bairros as $bairro): ?>
            <option value="<?= $bairro ?>"><?= $bairro ?></option>
          <?php endforeach; ?>
        </select>
        <select onchange="filtrar()" id="filtro-tipo">
          <option value="" disabled selected>Filtrar por espécie...</option>
          <option value="">Todos</option>
          <?php foreach ($tipos as $tipo): ?>
            <option value="<?= $tipo ?>"><?= ucfirst($tipo) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div id="cards-container" class="card-lista">
        <?php foreach (array_reverse($dados) as $pet): ?>
          <div class="card" data-bairro="<?= $pet['bairro'] ?>" data-tipo="<?= $pet['tipo'] ?>" data-status="<?= $pet['status'] ?>">
            <img src="<?= $pet['imagem'] ?>" alt="<?= $pet['nome'] ?>">
            <h3><?= !empty($pet['nome']) ? $pet['nome'] : 'NÃO IDENTIFICADO' ?></h3>
            <p>
              <strong><?= ucfirst($pet['tipo']) ?></strong> -
              <?php
                $cor = strtolower($pet['status']) === 'desaparecido'
                  ? 'background-color:#e74c3c;color:white;'
                  : 'background-color:#2ecc71;color:white;';
              ?>
              <span style="padding:1px 4px;border-radius:4px;font-weight:bold;<?= $cor ?>">
                <?= $pet['status'] ?>
              </span>
            </p>
            <p><?= $pet['cidade'] ?> - <?= $pet['bairro'] ?></p>
            <p><?= $pet['data'] ?></p>
            <p>📞 <span class="telefone"><?= preg_replace('/\D/', '', $pet['telefone']) ?></span>
          <a class="whatsapp-btn" href="https://wa.me/55<?= $pet['telefone'] ?>" target="_blank">
            <img src="img/icons/whatsapp-icon.png" alt="WhatsApp" style="width: 20px; height: 20px; vertical-align: middle;">
          </a>
          </p>  
            <strong>Descrição:</strong> 
            <p class="descricao"><?= !empty($pet['descricao']) ? htmlspecialchars($pet['descricao']) : 'Não informada' ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <div id="paginacao" class="paginacao"></div>
    </section>
  </main>
  <footer class="footer">
    <p>© 2025 - <?php echo date("Y");?><a href="https://github.com/joaopssouza" target="_blank"> Joao P. S. Souza</a> — Todos os direitos reservados.</p>
  </footer>
</body>
</html>
