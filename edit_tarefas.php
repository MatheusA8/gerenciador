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
        echo "<p style='text-align:center; color:green;'>Tarefa atualizada com sucesso!</p>";
    } else {
        echo "<p style='text-align:center; color:red;'>Erro: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            color: #003366;
            line-height: 1.6;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        header h1 {
            margin-bottom: 10px;
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

        form {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form input, form select, form button {
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input:focus, form select:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }
    </style>
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
