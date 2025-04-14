<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciador de Tarefas</title>
  <style>
    /* Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f8ff; /* Azul bem claro */
      color: #003366; /* Azul escuro */
      line-height: 1.6;
    }

    header {
      background-color: #007BFF; /* Azul vibrante */
      color: white;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    header h1 {
      margin-bottom: 10px;
    }

    nav {
      margin-top: 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: bold;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    nav a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    main {
      padding: 40px 20px;
      text-align: center;
    }

    main h2 {
      font-size: 1.8rem;
      color: #0056b3;
      background-color: white;
      display: inline-block;
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <header>
    <h1>Gerenciador de Tarefas</h1>
    <nav>
      <a href="cad_usuario.php">Cadastro de Usuário</a>
      <a href="tarefa.php">Cadastro de Tarefa</a>
      <a href="tarefas.php">Lista de Tarefas</a>
    </nav>
  </header>
  <main>
    <h2>Bem-vindo! Escolha uma opção acima para começar.</h2>
  </main>
</body>
</html>
