//Script para o formulario Popup

// Aguarda todo o HTML da página carregar antes de executar o JavaScript
document.addEventListener("DOMContentLoaded", () => {


  const btnAbrir = document.getElementById("btnAbrirFormulario");  // Botão flutuante que abre o formulário
  const btnFechar = document.getElementById("btnFecharFormulario");  // Botão que fecha o formulário
  const popup = document.getElementById("formPopup");  // Div do popup do formulário
  const selectAvcb = document.getElementById("tem_avcb");// Select que pergunta se possui AVCB
  const upload = document.getElementById("upload");// Div do upload do arquivo
  const form = document.querySelector("#formPopup form"); // Seleciona o formulário que está dentro do popup

  // Quando clicar no botão "+", mostra o popup
  btnAbrir.onclick = () => popup.style.display = "block";

  // Quando clicar no botão "✕", esconde o popup
  btnFechar.onclick = () => popup.style.display = "none";

  // Quando mudar o select "Possui AVCB?"
  selectAvcb.onchange = () => {

    // Se for "Sim", mostra o upload
    // Se for qualquer outro valor, esconde
    upload.style.display = selectAvcb.value === "Sim" ? "block" : "none";
  };
  
  // Intercepta o envio do formulário
  form.addEventListener("submit", function (e) {

    // Impede o comportamento padrão (recarregar a página)
    e.preventDefault();

    // Envia o formulário via fetch (AJAX)
    fetch(form.action, {
      method: "POST",
      body: new FormData(form) // Envia todos os campos + arquivo
    })

    // Converte a resposta do PHP para JSON
    .then(res => res.json())
    .then(data => {

      // Se o PHP retornar status ok, mostra a mensagem e reseta
      if (data.status === "ok") {
        alert("Solicitação enviada com sucesso!");
        form.reset();

        upload.style.display = "none"; // Esconde o campo de upload
        popup.style.display = "none"; // Fecha o popup

      } else {

        // Se houver erro retornado pelo PHP
        alert("Erro ao enviar: " + data.mensagem);
      }
    })

    // Caso ocorra erro de conexão
    .catch(() => {
      alert("Erro de conexão com o servidor");
    });
  });

});


//Filtrar avcb pendente e concluido

// Quando o select de status for alterado
document.getElementById("avcb_solicitadas").addEventListener("change", function () {

    const status = this.value;// Pega o valor selecionado (Pendente ou Concluida)

    // Se não escolher nada, não faz nada
    if (status === "") return;

    fetch("php/buscarSolicitacoes.php?status=" + status)  // Faz a requisição ao PHP passando o status pela URL
        .then(res => res.text()) // Recebe o HTML retornado pelo PHP

        // Insere o HTML dentro da div resultado de usuario do card
        .then(html => {
            document.getElementById("resultado").innerHTML = html;
        });
});

