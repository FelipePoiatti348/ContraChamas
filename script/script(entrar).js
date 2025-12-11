document.getElementById("formLogin").addEventListener("submit", function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("php/senha.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        const erro = document.getElementById("mensagemErro");

        if (data.status === "ok") {
            erro.style.display = "none";
            window.location.href = "usuario.html";
        } else {
            erro.innerText = "E-mail ou senha incorretos!";
            erro.style.display = "block";
        }
    })
    .catch(() => {
        const erro = document.getElementById("mensagemErro");
        erro.innerText = "Erro ao acessar o servidor.";
        erro.style.display = "block";
    });
});
