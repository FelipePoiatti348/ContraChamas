// Script de para confirma se a senha e igual nos dois campos
function validarSenha() {

    let senha = document.getElementById("senha").value;    // Obtém o valor digitado no campo "senha"
    let confirmar = document.getElementById("confirmar_senha").value;    // Obtém o valor digitado no campo "confirmar_senha"
    let msgErro = document.getElementById("erroSenha");    // Seleciona o elemento onde será exibida a mensagem de erro

    // Verifica se a senha e a confirmação são diferentes
    if (senha !== confirmar) {
        msgErro.style.display = "block";        // Se forem diferentes, mostra a mensagem de erro
        return false;       // Retorna false para impedir o envio do formulário
    }

    msgErro.style.display = "none";    // Se as senhas forem iguais, esconde a mensagem de erro

    return true;    // Retorna true permitindo o envio para enviar.php
}

