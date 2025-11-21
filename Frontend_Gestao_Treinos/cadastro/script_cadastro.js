

document.getElementById("formcadastro").addEventListener("submit", function(e){
    e.preventDefault();

    const data = {
        nome: document.getElementById("nome").value,
        idade: document.getElementById("idade").value,
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value,
        cpf: document.getElementById("cpf").value
    }

    fetch("http://127.0.0.1:8000/api/cadastro", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body:JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log("sucesso:", data);
        window.location.href="index.html";
    })
    .catch(error => {
        console.error("Erro:", error)
    })
})