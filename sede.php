<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="IMG/favicon.jpg" type="image/x-icon">
    
    <title>Eventos</title>
</head>
<body>
  <nav>
    <a href="agenda.html" target="" rel="noopener noreferrer">Voltar a tela inicial</a>
    <h1>Pesquisar pelo Titulo</h1>
    <form method="POST" action="sede.php"> <!-- Corrigido para apontar para o mesmo arquivo -->
        Pesquisar:<input type="text" name="pesquisar" placeholder="PESQUISAR">
        <input class="envia-query" type="submit" value="ENVIAR">
    </form>
  </nav>

<?php
$conexao = null; // Inicializa a variável de conexão

if (isset($_POST['pesquisar'])) {
    include_once('config.php');

    // Tenta estabelecer a conexão
    $conexao = pg_connect($dbConnectionString);
    
    if (!$conexao) {
        die("Erro na conexão: " . pg_last_error());
    }

    // Escapar a entrada do usuário para evitar SQL Injection
    $pesquisar = pg_escape_string($conexao, $_POST['pesquisar']);
    
    // Consulta ao banco de dados
    $sql = "SELECT titulo, data_inicial, data_fim, descricao FROM evento WHERE titulo ILIKE '%$pesquisar%'";
    $result = pg_query($conexao, $sql);

    if (!$result) {
        die("Erro na consulta: " . pg_last_error($conexao));
    }

    if (pg_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>Título</th>
                    <th>Data Inicial</th>
                    <th>Data de Término</th>
                    <th>Descrição</th>
                </tr>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["titulo"]) . "</td>
                    <td>" . htmlspecialchars($row["data_inicial"]) . "</td>
                    <td>" . htmlspecialchars($row["data_fim"]) . "</td>
                    <td>" . htmlspecialchars($row["descricao"]) . "</td>
                  </tr>";
        }
        echo "</table>"; // Fechar a tabela aqui
    } else {
        echo "0 resultados";
    }

    // Libera o resultado
    pg_free_result($result);
}

// Verifica se a conexão foi estabelecida antes de tentar fechá-la
if ($conexao) {
    // Fecha a conexão
    pg_close($conexao);
}
?>
<style>
  /* reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background-color: #141414;
  font-family: "Times New Roman", Times, serif;
  color: white;
}

a {
  border: none;
  display: inline-block;
  padding: 8px 16px;
  vertical-align: middle;
  overflow: hidden;
  text-decoration: none;
  color: inherit;
  text-align: center;
  cursor: pointer;
  white-space: nowrap;
  font-size: 18px !important;
  color: #fff !important;
  background-color: #085F63 !important;
}

table, th, td {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  margin: auto;
}

th, td {
  padding: 10px;
  text-align: center;
  width: 120px;
}

th {
  font-weight: bold;
}

tr:hover:nth-child(1 n + 2) {
  background-color: #085F63;
  color: #fff;
}

nav {
  border-collapse: collapse;
  margin: auto;
  padding: 30px;
  text-align: center;
  width: 1000px;
}

.envia-query {
  border: none;
  display: inline-block;
  padding: 8px 16px;
  vertical-align: middle;
  overflow: hidden;
  text-decoration: none;
  color: inherit;
  text-align: center;
  cursor: pointer;
  white-space: nowrap;
  font-size: 18px !important;
  color: #fff !important;
  background-color: #085F63 !important;
}
</style>
</body>
</html>