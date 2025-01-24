<a href="agenda.html" target="" rel="noopener noreferrer">voltar a tela inicial</a>
<?php

    // conexão com o banco de Dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "datas_agenda";
   
    //Criar a conexao
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    
    // query no db 
    $pesquisar = $_POST['pesquisar'];
    $result_cursos = "SELECT * FROM evento WHERE titulo LIKE '%$pesquisar%' ";
    $resultado_cursos = mysqli_query($conn, $result_cursos);
    if (mysqli_num_rows($resultado_cursos) > 0) {
   while($row = mysqli_fetch_array($resultado_cursos)){
        
        echo"<table> <tr>
        
          <th>Título: </th>
          <th>Data inicial: </th>
          <th>Data de terminio: </th>
          </tr>";
          echo "<td>" . $row["titulo"]."</td>"."<td>" . $row["data_inicial"]."</td>"."<td>" . $row["data_fim"]."</td>"."<br>";
    }
} else {
    echo "0 resultados";
  
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

th, td{
padding: 10px;
text-align: center;
width: 120px;
}

th{
font-weight: bold;
}



tr:hover:nth-child(1n + 2) {
background-color: #085F63;
color: #fff;
}

</style>