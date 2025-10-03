<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastrar_produto.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$preco_venda = (float)($_POST['preco_venda'] ?? 0);
$estoque_minimo = (int)($_POST['estoque_minimo'] ?? 0);

if (!$nome || $preco_venda <= 0) {
    die("<div class='alert alert-error'>❌ Nome e Preço de Venda são obrigatórios!</div><br><a href='cadastrar_produto.php' class='btn btn-amarelo'>Voltar</a>");
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO produtos (nome, preco_venda, quantidade, estoque_minimo)
        VALUES (?, ?, 0, ?)
    ");
    $stmt->execute([$nome, $preco_venda, $estoque_minimo]);

    header('Location: index.php?msg=✅ Produto "' . urlencode($nome) . '" cadastrado com sucesso!');
    exit;
} catch (PDOException $e) {
    die("<div class='alert alert-error'>❌ Erro ao salvar: " . htmlspecialchars($e->getMessage()) . "</div><br><a href='cadastrar_produto.php' class='btn btn-amarelo'>Tentar novamente</a>");
}
?>