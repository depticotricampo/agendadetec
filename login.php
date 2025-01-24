<?php
session_start();
require 'config.php'; // Inclui o arquivo de configuração

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['user'];
    $senha = $_POST['senha'];

    // Prepara a consulta
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se o usuário existe
    if ($resultado->num_rows > 0) {
        $usuario_db = $resultado->fetch_assoc();
        
        // Verifica a senha
        if (password_verify($senha, $usuario_db['senha'])) {
            // Senha correta, inicia a sessão
            $_SESSION['usuario'] = $usuario_db['usuario'];
            echo "Login bem-sucedido! Bem-vindo, " . htmlspecialchars($usuario_db['usuario']) . "!";
            // Redirecionar para uma página protegida ou dashboard
            // header("Location: dashboard.php");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
} else {
    echo "Método de requisição inválido.";
}

$conexao->close(); // Fecha a conexão
?>