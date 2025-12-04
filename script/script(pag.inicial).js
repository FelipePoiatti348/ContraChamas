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



//Script para a pagina do sobre "solicitar avcb" puxar para esse formulario
document.addEventListener("DOMContentLoaded", function () { // Aguarda todo o HTML ser carregado antes de executar o script

    const headerAltura = 140; // Define a altura do cabeçalho fixo para descontar do scrollaltura do cabeçalho(140)

    if (window.location.hash === "#form-avcb") { // Verifica se a URL contém a âncora #form-avcb
 
        setTimeout(() => { // Atraso para garantir que tudo esteja carregado antes de calcular o scroll
             const alvo = document.querySelector("#form-avcb");// Seleciona o elemento que possui o ID "form-avcb"

            // Verifica se o elemento existe na página
            if (alvo) {

                // Calcula a posição exata para onde deve rolar,levando em conta o scroll atual, a posição do elemento,e a altura do cabeçalho fixo
                const posicao = alvo.getBoundingClientRect().top + window.scrollY - headerAltura - 20;

                // Faz o scroll suave até a posição calculada
                window.scrollTo({
                    top: posicao,
                    behavior: "smooth"
                });
            }

        }, 200); // Tempo de espera para garantir carregamento total do conteúdo
    }
});




