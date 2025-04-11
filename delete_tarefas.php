<?php
include 'conexao.php';  // Inclui a conexão com o banco de dados

// Verifica se o parâmetro id foi passado na URL
if (isset($_GET['id'])) {
    $id_tarefa = $_GET['id'];

    // Prepara a query para excluir a tarefa
    $sql = "DELETE FROM tarefa WHERE id_tarefa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_tarefa);

    if ($stmt->execute()) {
        echo "Tarefa excluída com sucesso!";
        header("Location: tarefas.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>
