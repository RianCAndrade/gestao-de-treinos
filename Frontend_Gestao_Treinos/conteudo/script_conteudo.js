document.getElementById("logout").addEventListener("click", async function name(e) {
    e.preventDefault();

    const xsrf = decodeURIComponent(document.cookie.split('; ').find(c => c.startsWith('XSRF-TOKEN='))?.split('=')[1] || '');


    try {
        await fetch("http://localhost:8001/api/logout", {
            method: "POST",
            credentials: "include",
            headers: {
                "Accept": "application/json",
                "Content-type": "application/json",
                "XSRF" : xsrf
            }
        })

        console.log("Usuario deslogado com sucesso");
    } catch (error) {
        console.warn("Erro tecnico ao tentar logout, forçando a saida visual", error)
    } finally {
        window.location.href="/Frontend_Gestao_Treinos/login/index.html"
    }
})
