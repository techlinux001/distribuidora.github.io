<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=estoque_db;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("❌ Erro na conexão com o banco: " . $e->getMessage());
}
?>