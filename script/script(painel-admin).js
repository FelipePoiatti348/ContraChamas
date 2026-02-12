document.getElementById("filtro").addEventListener("change", function() {

    let status = this.value;

    fetch("php/listar-solicitacoes.php?filtro=" + status)
    .then(response => response.text())
    .then(data => {
        document.getElementById("resultado").innerHTML = data;
    });

});

/* Carrega tudo ao abrir */
fetch("php/listar-solicitacoes.php")
.then(response => response.text())
.then(data => {
    document.getElementById("resultado").innerHTML = data;
});
