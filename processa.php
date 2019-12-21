<?php

// Banco de dados
$server = 'localhost';
$user   = 'root';
$pass   = 'admin123';
$base   = 'alunos_ajax';

$connect = new mysqli($server, $user, $pass, $base) or die('Error to connect!');

if (isset($_GET['buscanome'])) {

  // Busca
  $nome = $_GET['buscanome'];

  if (empty($nome)) {
    $query = "
      SELECT *
      FROM alunos
      ";
  } else {
    $query = "
      SELECT *
      FROM alunos
      WHERE nome LIKE '%$nome%'
    ";
  }

  $sql = $connect->query($query);

  $count = $sql->num_rows; // retorna o número de linhas da busca

  sleep(1);

  if ($count > 0) {
    // Exibe
    echo '<table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>ENDEREÇO</th>
                <th>EXCLUIR</th>
              </tr>
            </thead>
          <tbody>';

    while ($row = $sql->fetch_array()) {
      echo '<tr>';
      echo '<td>' . $row['ID'] . '</td>';
      echo '<td>' . $row['NOME'] . '</td>';
      echo '<td>' . $row['EMAIL'] . '</td>';
      echo '<td>' . $row['TELEFONE'] . '</td>';
      echo '<td>' . $row['ENDERECO'] . '</td>';
      echo '<td><a href="#" onclick="deletaUsuario('. $row['ID'] .')">Deletar</a></td>';
      echo '<br>';
      echo '</tr>';
    }
    echo '</tbody></table>';
  } else
  {
    echo 'Nenhum registro encontrado.';
  }
} elseif(
  // Pega os dados do front via GET
  isset($_GET['nome']) and
  isset($_GET['email']) and
  isset($_GET['telefone']) and
  isset($_GET['endereco'])
  )
{
  // Guarda os dados do front em variáveis
  $nome     = $_GET['nome'];
  $email    = $_GET['email'];
  $telefone = $_GET['telefone'];
  $endereco = $_GET['endereco'];

  // Query para inserir dados na base
  $query = "
  INSERT INTO alunos(NOME, EMAIL, TELEFONE, ENDERECO) 
  VALUES('$nome', '$email', '$telefone', '$endereco')
  ";

  sleep(1);

  // Conexão e execução da query
  $sql = $connect->query($query);
  echo '<span class="btn btn-success">Inserido com sucesso!</span>';
} elseif(isset($_GET['deleta']))
{
  $id = $_GET['deleta'];
  $query = "
  DELETE
  FROM alunos
  WHERE ID = '$id'
  ";

  sleep(1);

  // Conexão e execução da query
  $sql = $connect->query($query);
  echo '<span class="btn btn-danger">Deletado com sucesso!</span>';
} else
{
  echo '<center><span class="btn btn-danger">Um erro ocorreu. Por favor, preencha todos os campos</span></center>';
}