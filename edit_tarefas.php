<?php
include 'conexao.php';  // Inclui a conexão com o banco de dados

// Verifica se o parâmetro id foi passado na URL
if (isset($_GET['id'])) {
    $id_tarefa = $_GET['id'];

    // Consulta para buscar os dados da tarefa com base no ID
    $sql = "SELECT * FROM tarefa WHERE id_tarefa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tarefa);
    $stmt->execute();
    $result = $stmt->get_result();
    $tarefa = $result->fetch_assoc();
} else {
    // Se não encontrar o ID, redireciona para a lista de tarefas
    header('Location: tarefas.php');
    exit();
}

// Atualiza a tarefa no banco de dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $data = $_POST['data'];
    $prioridade = $_POST['prioridade'];
    $status = $_POST['status'];
    $id_usuario = $_POST['id_usuario'];

    // Prepara a query para atualizar a tarefa
    $sql = "UPDATE tarefa SET descricao = ?, setor = ?, data_cadastro = ?, prioridade = ?, status = ?, id_usuario = ? WHERE id_tarefa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $descricao, $setor, $data, $prioridade, $status, $id_usuario, $id_tarefa);

    if ($stmt->execute()) {
        echo "Tarefa atualizada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Editar Tarefa</h1>
        <nav>
            <a href="index.php">Início</a>
            <a href="cad_usuario.php">Cadastro de Usuário</a>
            <a href="tarefa.php">Cadastro de Tarefa</a>
            <a href="tarefas.php">Lista de Tarefas</a>
        </nav>
    </header>

    <form method="POST" action="edit_tarefa.php?id=<?php echo $tarefa['id_tarefa']; ?>">
        <input type="text" name="descricao" value="<?php echo $tarefa['descricao']; ?>" placeholder="Descrição da tarefa" required>
        <input type="text" name="setor" value="<?php echo $tarefa['setor']; ?>" placeholder="Setor" required>
        <input type="date" name="data" value="<?php echo $tarefa['data_cadastro']; ?>" required>
        <select name="prioridade" required>
            <option value="Baixa" <?php if ($tarefa['prioridade'] == 'Baixa') echo 'selected'; ?>>Baixa</option>
            <option value="Média" <?php if ($tarefa['prioridade'] == 'Média') echo 'selected'; ?>>Média</option>
            <option value="Alta" <?php if ($tarefa['prioridade'] == 'Alta') echo 'selected'; ?>>Alta</option>
        </select>
        <select name="status" required>
            <option value="A fazer" <?php if ($tarefa['status'] == 'A fazer') echo 'selected'; ?>>A fazer</option>
            <option value="Fazendo" <?php if ($tarefa['status'] == 'Fazendo') echo 'selected'; ?>>Fazendo</option>
            <option value="Pronto" <?php if ($tarefa['status'] == 'Pronto') echo 'selected'; ?>>Pronto</option>
        </select>

        <select name="id_usuario" required>
            <?php
            $usuarios = $conn->query("SELECT * FROM usuario")->fetch_all(MYSQLI_ASSOC);
            foreach ($usuarios as $usuario) {
                $selected = ($usuario['id_usuario'] == $tarefa['id_usuario']) ? 'selected' : '';
                echo "<option value='{$usuario['id_usuario']}' $selected>{$usuario['nome']}</option>";
            }
            ?>
        </select>

        <button type="submit">Atualizar Tarefa</button>
    </form>
</body>
</html>
