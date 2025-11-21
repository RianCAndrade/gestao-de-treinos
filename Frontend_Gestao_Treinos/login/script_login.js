document.getElementById("formlogin").addEventListener("submit", function(e){
    e.preventDefault();

    const data = {
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value,
    }

    fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body:JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        console.log("sucesso:", data);
        window.location.href="conteudo.html";
    })
    .catch(error => {
        console.error("Erro:", error)
    })
})