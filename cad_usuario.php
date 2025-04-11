<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    // Prepara a query para inserir o usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuario (nome, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $email);

    // Executa a query e exibe o resultado
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close(); // Fecha a consulta preparada
    $conn->close(); // Fecha a conexão com o banco de dados
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Cadastro de Usuário</h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="cad_usuario.php">Cadastro de Usuário</a>
            <a href="tarefa.php">Cadastro de Tarefa</a>
            <a href="tarefas.html">Lista de Tarefas</a>
        </nav>
    </header>

    <form id="user-form" method="post">
        <input type="text" id="nome" name="nome" placeholder="Nome" required>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <button type="submit">Cadastrar Usuário</button>
    </form>
</body>
</html>
