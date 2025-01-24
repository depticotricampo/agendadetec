<?php
require 'verificar_login.php';
if(isset($_GET['Consultar_Data'])){
    include_once('config.php');
    $sql = "SELECT titulo, data_inicial,data_fim, descricao FROM evento";
    $result = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "titulo: " . $row["titulo"]. " Data inicial: " . $row["data_inicial"]. " - Data de terminio: " . $row["data_fim"].  " - Descrição: " . $row["descricao"]. "<br>";
        }
      } else {
        echo "0 results";
      }

}


$conexao->close();
