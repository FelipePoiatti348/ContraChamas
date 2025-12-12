// Script que adiciona um evento ao formulário com id "formLogin" que será executado ao enviar
document.getElementById("formLogin").addEventListener("submit", function(e) {

    e.preventDefault();    // Impede que o formulário seja enviado da forma tradicional (recarregando a página)
    const formData = new FormData(this);    // Cria um objeto FormData com todos os campos do formulário

    // Envia os dados para o arquivo PHP usando fetch
    fetch("php/senha.php", {
        method: "POST",      // Método de envio
        body: formData       // Dados enviados no corpo da requisição
    })

    .then(res => res.json()) // Converte a resposta do servidor para JSON

    // Trata o JSON recebido
    .then(data => {
        const erro = document.getElementById("mensagemErro");  // Pega a área onde a mensagem de erro será mostrada

        // Se o PHP retornou status "ok" (login correto)
        if (data.status === "ok") {

            erro.style.display = "none"; // Esconde a mensagem de erro
            window.location.href = "usuario.html"; // Redireciona o usuário para a página de usuário
        } else {

            // Exibe mensagem de erro caso o login esteja incorreto
            erro.innerText = "E-mail ou senha incorretos!";
            erro.style.display = "block";
        }
    })

    // Caso ocorra erro de comunicação com o servidor
    .catch(() => {
        const erro = document.getElementById("mensagemErro");
        erro.innerText = "Erro ao acessar o servidor.";
        erro.style.display = "block";
    });
});
