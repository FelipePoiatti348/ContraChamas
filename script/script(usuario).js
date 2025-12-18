document.addEventListener("DOMContentLoaded", () => {

  const btnAbrir = document.getElementById("btnAbrirFormulario");
  const btnFechar = document.getElementById("btnFecharFormulario");
  const popup = document.getElementById("formPopup");

  const selectAvcb = document.getElementById("tem_avcb");
  const upload = document.getElementById("upload");

  const form = document.querySelector("#formPopup form");

  // abrir popup
  btnAbrir.onclick = () => popup.style.display = "block";

  // fechar popup
  btnFechar.onclick = () => popup.style.display = "none";

  // mostrar upload se Sim
  selectAvcb.onchange = () => {
    upload.style.display = selectAvcb.value === "Sim" ? "block" : "none";
  };
  
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    fetch(form.action, {
      method: "POST",
      body: new FormData(form)
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "ok") {
        alert("Solicitação enviada com sucesso!");
        form.reset();
        upload.style.display = "none";
        popup.style.display = "none";
      } else {
        alert("Erro ao enviar: " + data.mensagem);
      }
    })
    .catch(() => {
      alert("Erro de conexão com o servidor");
    });
  });

});
