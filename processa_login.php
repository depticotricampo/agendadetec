<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Conexão com PostgreSQL
    $dbConnectionString = "postgresql://neondb_owner:npg_y3fzF1kdcTxM@ep-spring-butterfly-a5f6zfko-pooler.us-east-2.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-spring-butterfly-a5f6zfko-pooler";
    $conexao = pg_connect($dbConnectionString);

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro na conexão com o banco de dados.");
    }

    // Prepara a consulta SQL
    $sql = "SELECT * FROM usuarios WHERE usuario = $1 AND senha = $2";
    $stmt = pg_prepare($conexao, "login_query", $sql);
    $result = pg_execute($conexao, "login_query", array($usuario, $senha));

    // Verifica se o usuário foi encontrado
    if (pg_num_rows($result) > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: agenda.html");
        exit(); // Certifique-se de chamar exit após o redirecionamento
    } else {
        echo "Usuário ou senha incorretos!";
    }

    // Fecha a conexão
    pg_close($conexao);
}
?>