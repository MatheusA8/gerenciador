<?php
include 'conexao.php';  // Inclui a conexão com o banco de dados

// Consulta para buscar todas as tarefas
$sql = "SELECT * FROM tarefa";
$result = $conn->query($sql);

// Verifica se há tarefas cadastradas
if ($result->num_rows > 0) {
    // Exibe as tarefas em uma tabela
    echo "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Setor</th>
                    <th>Data Cadastro</th>
                    <th>Prioridade</th>
                    <th>Status</th>
                    <th>Usuário</th>
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
    echo "Não há tarefas cadastradas.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="styles.css">
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

    <div>
        <!-- A lista de tarefas será exibida aqui -->
    </div>
</body>
</html>
