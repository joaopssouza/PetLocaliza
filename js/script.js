/** 
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

function mostrarFormularioExclusao() {
  const form = document.getElementById('formExclusao');
  const cadastro = document.getElementById('form-section');
  form.style.display = (form.style.display === 'none') ? 'block' : 'none';

  if (cadastro.style.display === 'block'){
      cadastro.classList.remove('show');  
      cadastro.classList.add('hidden')
  }
}

function confirmarExclusao() {
          return confirm("Tem certeza que deseja excluir esse cadastro?");
}
      
function toggleForm(acao) {
  const form = document.getElementById('form-section');
  const lista = document.getElementById('listagem');
  const exclusao = document.getElementById('formExclusao');

  // Esconde o formulário de exclusão

  if (acao === 'Desaparecido') {
    form.classList.add('show');
    form.classList.remove('hidden');
    lista.style.display = 'none';
    form.style.display = (lista.style.display === 'none') ? 'block' : 'none';
    
    if (exclusao.style.display == 'block'){
      exclusao.style.display = 'none'
    }

  } else if (acao === 'Encontrado') {
    form.classList.remove('show');
    form.classList.add('hidden');
    lista.style.display = 'block';

    if (exclusao.style.display == 'block'){
      exclusao.style.display = 'none'
    }
    
    lista.scrollIntoView({ behavior: 'smooth' });
  }
}

function filtrar() {
  const tipo = document.getElementById('filtro-tipo').value.toLowerCase();
  const bairro = document.getElementById('filtro-bairro').value.toLowerCase();
  const status = document.getElementById('filtro-status').value.toLowerCase();
  document.querySelectorAll('.card').forEach(card => {
    const tipoCard = card.getAttribute('data-tipo').toLowerCase();
    const bairroCard = card.getAttribute('data-bairro').toLowerCase();
    const statusCard = card.getAttribute('data-status').toLowerCase();
    card.style.display = (!tipo || tipoCard === tipo) && (!bairro || bairroCard === bairro) && (!status || statusCard === status) ? 'block' : 'none';
  });
}

// Formata enquanto digita
function mascaraTelefone(input) {
  let valor = input.value.replace(/\D/g, '');
  if (valor.length > 11) valor = valor.slice(0, 11);

  let resultado = '';

  if (valor.length >= 1) {
    resultado += '(' + valor.substring(0, 2);
  }
  if (valor.length >= 3) {
    resultado += ') ' + valor.substring(2, 3);
  }
  if (valor.length >= 4) {
    resultado += ' ' + valor.substring(3, 7);
  }
  if (valor.length >= 8) {
    resultado += '-' + valor.substring(7);
  }

  input.value = resultado;
}

// Remove a máscara para enviar o valor limpo
function removerMascaraTelefone(valor) {
  return valor.replace(/\D/g, '');
}

// Aplica eventos quando o DOM carregar
document.addEventListener('DOMContentLoaded', () => {
  const telefoneInput = document.getElementById('telefone');
  
  if (telefoneInput) {
    telefoneInput.addEventListener('input', () => mascaraTelefone(telefoneInput));
  }

// Ao enviar o formulário, limpar o telefone
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', () => {
      telefoneInput.value = removerMascaraTelefone(telefoneInput.value);
    });
  }

// Formatar os telefones visíveis (nos cards)
  document.querySelectorAll('.telefone').forEach(el => {
    el.textContent = mascaraTelefoneFormatado(el.textContent);
  });
});

// Também aplica a máscara visual aos cards
function mascaraTelefoneFormatado(tel) {
  tel = tel.replace(/\D/g, '');
  if (tel.length === 11) {
    return `(${tel.slice(0,2)}) ${tel.slice(2,3)} ${tel.slice(3,7)}-${tel.slice(7)}`;
  }
  return tel;
}




function formatarTelefone(tel) {
  tel = tel.replace(/\D/g, ''); // remove tudo que não for dígito
  if (tel.length === 11) {
    return `(${tel.slice(0,2)}) ${tel.slice(2,3)} ${tel.slice(3,7)}-${tel.slice(7)}`;
  }
  return tel;
}

// Aplicar formatação ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.telefone').forEach(el => {
    el.textContent = formatarTelefone(el.textContent);
  });
});


// Paginação dos CARDS
const cardsPorPagina = 9;
let paginaAtual = 1;

function paginarCards() {
  const cards = document.querySelectorAll("#cards-container .card");
  const totalPaginas = Math.ceil(cards.length / cardsPorPagina);

  cards.forEach((card, index) => {
    card.style.display = (index >= (paginaAtual - 1) * cardsPorPagina && index < paginaAtual * cardsPorPagina) ? 'block' : 'none';
  });

  const paginacao = document.getElementById("paginacao");
  paginacao.innerHTML = '';

  if (totalPaginas <= 1) return;

  // Botões: Primeira página e anterior
  if (paginaAtual > 1) {
    paginacao.innerHTML += `<button onclick="irParaPagina(1)">Primeira</button>`;
    paginacao.innerHTML += `<button onclick="irParaPagina(${paginaAtual - 1})"><</button>`;
  }

  for (let i = 1; i <= totalPaginas; i++) {
    paginacao.innerHTML += `<button class="${paginaAtual === i ? 'active' : ''}" onclick="irParaPagina(${i})">${i}</button>`;
  }

  // Botões: próxima e última
  if (paginaAtual < totalPaginas) {
    paginacao.innerHTML += `<button onclick="irParaPagina(${paginaAtual + 1})">></button>`;
    paginacao.innerHTML += `<button onclick="irParaPagina(${totalPaginas})">Última</button>`;
  }
}

function irParaPagina(pagina) {
  paginaAtual = pagina;
  paginarCards();
}

// Inicializar após carregar os cards
window.addEventListener("load", () => {
  paginarCards();
});