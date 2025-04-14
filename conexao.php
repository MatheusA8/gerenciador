<?php
$host = "127.0.0.1";
$usuario = "root";
$senha = "";
$banco = "gerenciador_tarefas"; 
$port = "3306";

// Cria a conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco, $port);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
