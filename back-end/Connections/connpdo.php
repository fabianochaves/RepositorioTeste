<?php
$conn = null;
try {
    // Dados da conexão PostgreSQL
    $host = 'dcs-postgres'; // Endereço do servidor PostgreSQL
    $port = '5432'; // Porta padrão do PostgreSQL
    $database = 'pdv'; // Nome do banco de dados
    $db_user = 'pdv'; // Nome de usuário
    $db_password = '123'; // Senha do usuário

    // Instancia a classe PDO para a conexão ao PostgreSQL com as opções
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$database;user=$db_user;password=$db_password");

    // Configuração das opções após a conexão ser estabelecida
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo 'Não foi possível se conectar (Aplicação): ' . $e->getMessage();
    exit();
}
?>
