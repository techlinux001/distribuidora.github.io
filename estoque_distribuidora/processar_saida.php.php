<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registrar_saida.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$quantidade = (int)($_POST['quantidade'] ?? 0);

if (!$nome || $quantidade <= 0) {
    die("<div class='alert alert-error'>❌ Dados inválidos!</div><br><a href='registrar_saida.php' class='btn btn-amarelo'>Voltar</a>");
}

try {
    $stmt = $pdo->prepare("SELECT id, quantidade FROM produtos WHERE nome = ?");
    $stmt->execute([$nome]);
    $produto = $stmt->fetch();

    if (!$produto) {
        die("<div class='alert alert-error'>❌ Produto \"" . htmlspecialchars($nome) . "\" não encontrado!</div><br><a href='registrar_saida.php' class='btn btn-amarelo'>Tentar novamente</a>");
    }

    if ($produto['quantidade'] < $quantidade) {
        die("<div class='alert alert-error'>❌ Estoque insuficiente! Disponível: {$produto['quantidade']} unidades.</div><br><a href='registrar_saida.php' class='btn btn-amarelo'>Tentar novamente</a>");
    }

    $nova_qtd = $produto['quantidade'] - $quantidade;
    $pdo->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?")
        ->execute([$nova_qtd, $produto['id']]);

    header("Location: index.php?msg=✅ Saída registrada! -$quantidade unidades de \"" . urlencode($nome) . "\"");
    exit;
} catch (Exception $e) {
    die("<div class='alert alert-error'>❌ Erro: " . htmlspecialchars($e->getMessage()) . "</div><br><a href='registrar_saida.php' class='btn btn-amarelo'>Voltar</a>");
}
?>