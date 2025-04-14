<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $setor = $_POST['setor'];
    $prioridade = $_POST['prioridade'];
    $id_usuario = $_POST['id_usuario'];
    $data = date('Y-m-d'); // Adiciona a data atual

    // Prepara a query para inserir a tarefa no banco de dados
    $sql = "INSERT INTO tarefa (descricao, setor, data_cadastro, prioridade, id_usuario)
            VALUES ('$descricao', '$setor', '$data', '$prioridade', '$id_usuario')";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        echo "<p style='text-align:center; color:green;'>Tarefa cadastrada com sucesso!</p>";
    } else {
        echo "<p style='text-align:center; color:red;'>Erro: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Tarefa</title>
    <style>
        /* Reset */
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
        <h1>Cadastro de Tarefa</h1>
        <nav>
            <a href="index.php">Início</a>
            <a href="cad_usuario.php">Cadastro de Usuário</a>
            <a href="tarefa.php">Cadastro de Tarefa</a>
            <a href="tarefas.php">Lista de Tarefas</a>
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

        <select id="id_usuario" name="id_usuario" required>
            <?php
            // Carrega os usuários do banco de dados
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
