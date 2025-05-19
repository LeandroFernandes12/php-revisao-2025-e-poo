<?php
require_once 'config/database.php';
try {
    $conn = conectarBD();
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>