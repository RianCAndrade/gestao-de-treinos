document.getElementById("formlogin").addEventListener("submit", async function(e){
    e.preventDefault();

    const data = {
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value,
    }
    // console.log(data);
    // Primeiro buscar o csrf cookie
    await fetch('http://localhost:8001/sanctum/csrf-cookie', {
        method: "GET",
        credentials: 'include'
    });

    const xsrf = decodeURIComponent(document.cookie.split('; ').find(c => c.startsWith('XSRF-TOKEN='))?.split('=')[1] || '');

    await fetch("http://localhost:8001/api/login", {
        method: "POST",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-XSRF-TOKEN": xsrf
        },
        body:JSON.stringify(data)
    })
    .then(response => {
            if (!response.ok) {
                alert("Email ou senha inválidos");
                throw new Error("Login falhou");
            }
        return response.json();
    })
    .then(data => {
        window.location.href="/Frontend_Gestao_Treinos/conteudo/conteudo.html";
    })
    .catch(error => {
        console.error("Erro:", error)
    })


})