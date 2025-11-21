<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
  <title>Cadastro Usuário</title>
</head>
<body>
  <!-- Navbar -->
  <nav>
    <div class="logo">Gest Treinos</div>
    <div class="nav-links">
      <a href="/">Início</a>
      <a href="#">Sobre</a>
      <a href="#">Serviços</a>
      <a href="#">Contato</a>
    </div>
  </nav>

  <!-- Formulário de cadastro -->
  <div class="login-box">
    <h2>Cadastro de Usuário</h2>
    <form action="{{ route('cadastro.pessoaCadastro') }}" method="post">
      @csrf

      <div class="user-box">
        <input type="text" name="nome" required>
        <label>Nome</label>
      </div>

      <div class="user-box">
        <input type="number" name="idade" required>
        <label>Idade</label>
      </div>

      <div class="user-box">
        <input type="email" name="email" required>
        <label>Email</label>
      </div>

      <div class="user-box">
        <input type="password" name="senha" required>
        <label>Senha</label>
      </div>

      <div class="user-box">
        <input type="text" name="cpf" required>
        <label>CPF</label>
      </div>

      <button type="submit" class="a">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Cadastrar
      </button>
  </form>
  </div>

</body>
</html>
