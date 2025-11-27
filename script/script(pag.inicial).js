//Script  do botao de menu 
const btn = document.getElementById('btnToggle'); // botão que abre/fecha do menu
const sidebar = document.getElementById('sidebar'); // a barra lateral(sidebar)
const conteudo = document.getElementById('conteudo'); // conteúdo e endereço de paginas

btn.addEventListener('click', () => { // quando clicar no botão
  sidebar.classList.toggle('aberta'); // alterna a classe para abrir/fechar da barra lateral (sidebar)
  conteudo.classList.toggle('empurrado'); // empurra o conteúdo e endereço de paginas para o lado
});

//Script do upload do avcb
document.getElementById('tem_avcb').addEventListener('change', function() { // detecta mudança no select
  document.getElementById('upload').style.display = // mostra/esconde o campo upload
    this.value === 'Sim' ? 'block' : 'none';// se for "Sim" mostra, se não oculta
});



