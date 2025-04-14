<?php
include 'conexao.php';  // Inclui a conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
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

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        thead {
            background-color: #007BFF;
            color: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .mensagem {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lista de Tarefas</h1>
        <nav>
            <a href="index.php">Início</a>
            <a href="cad_usuario.php">Cadastro de Usuário</a>
            <a href="tarefa.php">Cadastro de Tarefa</a>
            <a href="tarefas.php">Lista de Tarefas</a>
        </nav>
    </header>

    <div class="container">
        <?php
        // Consulta para buscar todas as tarefas
        $sql = "SELECT * FROM tarefa";
        $result = $conn->query($sql);

        // Verifica se há tarefas cadastradas
        if ($result->num_rows > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Setor</th>
                            <th>Data Cadastro</th>
                            <th>Prioridade</th>
                            <th>Status</th>
                            <th>ID Usuário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Exibe cada tarefa cadastrada
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_tarefa']}</td>
                        <td>{$row['descricao']}</td>
                        <td>{$row['setor']}</td>
                        <td>{$row['data_cadastro']}</td>
                        <td>{$row['prioridade']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['id_usuario']}</td>
                        <td>
                            <a href='edit_tarefas.php?id={$row['id_tarefa']}'>Editar</a> | 
                            <a href='delete_tarefas.php?id={$row['id_tarefa']}'>Excluir</a>
                        </td>
                    </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p class='mensagem'>Não há tarefas cadastradas.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
