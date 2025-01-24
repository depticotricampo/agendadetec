<?php
// Configuração da conexão com o banco de dados PostgreSQL
$dbConnectionString = "postgresql://neondb_owner:npg_y3fzF1kdcTxM@ep-spring-butterfly-a5f6zfko-pooler.us-east-2.aws.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-spring-butterfly-a5f6zfko-pooler";

// Tenta estabelecer a conexão
$conexao = pg_connect($dbConnectionString);

// Verifica se a conexão foi bem-sucedida
if (!$conexao) {
    die("Erro na conexão: " . pg_last_error());
}

// Não se esqueça de fechar a conexão quando terminar
// pg_close($conexao);
?>
