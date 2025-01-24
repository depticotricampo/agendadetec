<?php
if (isset($_POST['submit'])) {
    include_once('config.php');

    $descricao = $_POST["desc"];
    $data_inicial = $_POST['d-i'];
    $data_fim = $_POST['d-f'];
    $titulo = $_POST["Nome"];

    // Conexão com PostgreSQL
    $dbConnectionString = "postgresql://neondb_owner:npg_y3fzF1kdcTxM@ep-spring-butterfly-a5f6zfko-pooler.us-east-2.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-spring-butterfly-a5f6zfko-pooler";
    $conexao = pg_connect($dbConnectionString);

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die("Erro na conexão com o banco de dados.");
    }

    // Prepara a consulta SQL
    $sql = "INSERT INTO evento (titulo, data_inicial, data_fim, descricao) VALUES ($1, $2, $3, $4)";
    $result = pg_prepare($conexao, "insert_event", $sql);
    $result = pg_execute($conexao, "insert_event", array($titulo, $data_inicial, $data_fim, $descricao));

    // Verifica se a inserção foi bem-sucedida
    if ($result) {
        // Redireciona para agenda.html após a inserção bem-sucedida
        header("Location: agenda.html");
        exit(); // Certifique-se de chamar exit após o redirecionamento
    } else {
        echo "Erro ao inserir evento.";
    }

    // Fecha a conexão
    pg_close($conexao);
}
?>