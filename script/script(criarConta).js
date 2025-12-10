
function validarSenha() {
    let senha = document.getElementById("senha").value;
    let confirmar = document.getElementById("confirmar_senha").value;
    let msgErro = document.getElementById("erroSenha");

    if (senha !== confirmar) {
        msgErro.style.display = "block";
        return false; // não envia
    }

    msgErro.style.display = "none";
    return true; // envia para enviar.php
}
