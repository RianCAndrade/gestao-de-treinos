<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Gestão de Treinos</title>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="logo">Gest Treinos</div>
    <div class="nav-links">
      <a href="/">Início</a>
      <a href="#">Sobre</a>
      <a href="/cadastro">Cadastrar Usuario</a>
      <a href="#">Serviços</a>
      <a href="#">Contato</a>
    </div>
  </nav>

  <!-- Login Box -->
  <div class="login-box">
    <h2>Login</h2>
    <form>
      @csrf
      <div class="user-box">
        <input type="text" name="email" required>
        <label>Email</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required>
        <label>Senha</label>
      </div>
      <a href="/conteudo">
        Enviar
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
    </form>
  </div>

</body>
</html>
