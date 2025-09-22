<?php

require_once __DIR__ . '/../data/config.php';

$deletDB = 'Drop Database IF EXISTS '. DB_Name. ';';
$criarDB = 'CREATE DATABASE IF NOT EXISTS '. DB_Name . ';';
$usarDB = 'USE '.DB_Name .';';

$createTable = "
    CREATE Table IF NOT EXISTS Atividade (
    id int primary key AUTO_INCREMENT,
    titulo VARCHAR(255) not NULL,
    descricao TEXT,
    inicio DATE,
    fim DATE,
    `status`  ENUM('Suave', 'Urgente', 'Concluida') DEFAULT 'Suave',
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
";

$insertDados = "
INSERT INTO Atividade (titulo, descricao, inicio, fim , `status`) VALUES
('Prova de Inglês', 'Verbo To Be', '2025-09-08', '2025-09-15', 'Suave'),
('Pesquisa de Quimica','Hidrocarbonetos','2025-09-01','2025-09-10','Urgente'),
('Atividade de Banco de Dados','Mysql','2025-09-01','2025-09-07','Concluida');
";

try {
    // Conexão inicial sem banco de dados
    $pdo = new PDO(
        dsn: 'mysql:host='.DB_HOST, 
        username: DB_USER, 
        password: DB_PASS
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Deletar banco de dados se existir
    $pdo->exec(statement: $deletDB);

    // Criar banco de dados
    $pdo->exec(statement: $criarDB);
    // Selecionar banco de dados
    $pdo->exec(statement: $usarDB);

    // Criar tabela
    $pdo->exec($createTable);

    // Inserir dados   
    $pdo->exec(statement: $insertDados);

    echo "Banco de dados, tabela e dados criados com sucesso!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
