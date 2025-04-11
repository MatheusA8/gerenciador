<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $data = $_POST['data'];
    $prioridade = $_POST['prioridade'];
    $status = $_POST['status'];
    $id_usuario = $_POST['id_usuario'];

    // Prepara a query para inserir a tarefa no banco de dados
    $sql = "INSERT INTO tarefa (descricao, setor, data_cadastro, prioridade, status, id_usuario)
            VALUES ('$descricao', '$setor', '$data', '$prioridade', '$status', '$id_usuario')";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "Tarefa cadastrada com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tarefa</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <header>
        <h1>Cadastro de Tarefa</h1>
        <nav>
            <a href="index.html">Início</a>
            <a href="cad_usuario.php">Cadastro de Usuário</a>
            <a href="tarefa.php">Cadastro de Tarefa</a>
            <a href="tarefas.html">Lista de Tarefas</a>
        </nav>
    </header>

    <form id="task-form" method="post" action="tarefa.php">
        <input type="text" id="descricao" name="descricao" placeholder="Descrição da tarefa" required>
        <input type="text" id="setor" name="setor" placeholder="Setor" required>
        <select id="prioridade" name="prioridade" required>
            <option value="">Prioridade</option>
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select>
        <input type="date" id="data" name="data" required>
        <select id="status" name="status" required>
            <option value="A fazer">A fazer</option>
            <option value="Fazendo">Fazendo</option>
            <option value="Pronto">Pronto</option>
        </select>
        <select id="id_usuario" name="id_usuario" required>
            <?php
            // Aqui você deve carregar os usuários do banco de dados
            $usuarios = $conn->query("SELECT * FROM usuario")->fetch_all(MYSQLI_ASSOC);
            foreach ($usuarios as $usuario) {
                echo "<option value='{$usuario['id_usuario']}'>{$usuario['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Cadastrar Tarefa</button>
    </form>
</body>
</html>
