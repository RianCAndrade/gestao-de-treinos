

document.getElementById("formcadastro").addEventListener("submit", function(e){
    e.preventDefault();

    const data = {
        nome: document.getElementById("nome").value,
        idade: document.getElementById("idade").value,
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value,
        cpf: document.getElementById("cpf").value
    }
    // console.log(data);
    fetch("http://localhost:8001/api/cadastro", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        
        body:JSON.stringify(data)
    })
    .then(response => {
        // console.log(response)
        if (!response.ok) {
            alert("Email ou outros campos invalidos");
            throw new Error("Falha ao cadastrar");
        }
        return response.json();
    })
    .then(data => {
        // console.log("sucesso:", data);
        window.location.href="/Frontend_Gestao_Treinos/login/index.html";
    })
    .catch(error => {
        console.error("Erro:", error)
    })
})