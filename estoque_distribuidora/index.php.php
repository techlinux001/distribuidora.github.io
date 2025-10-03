<?php
require_once 'conexao.php';

$busca = $_GET['busca'] ?? '';
if ($busca) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
    $stmt->execute(["%$busca%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
}
$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque - Dois Irmãos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Logo Distribuidora Dois Irmãos">
    </div>

    <div class="nav">
        <a href="cadastrar_produto.php">➕ Cadastrar Produto</a>
        <a href="registrar_entrada.php">📥 Entrada</a>
        <a href="registrar_saida.php">📤 Saída</a>
        <a href="index.php">🏠 Início</a>
    </div>

    <div class="container">
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
        <?php endif; ?>

        <h1>📦 Controle de Estoque</h1>

        <form method="GET" style="margin-bottom: 20px;">
            <div class="form-group">
                <label for="busca">Buscar Produto:</label>
                <input type="text" name="busca" id="busca" value="<?= htmlspecialchars($busca) ?>" placeholder="Nome do produto...">
                <button type="submit" class="btn btn-amarelo">🔎 Buscar</button>
                <?php if ($busca): ?>
                    <a href="index.php" class="btn btn-verde">Limpar</a>
                <?php endif; ?>
            </div>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Venda</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produtos)): ?>
                        <tr><td colspan="4" style="text-align:center; padding: 20px;">Nenhum produto cadastrado.</td></tr>
                    <?php else: ?>
                        <?php foreach ($produtos as $p): ?>
                            <tr class="<?= ($p['quantidade'] <= $p['estoque_minimo'] && $p['estoque_minimo'] > 0) ? 'estoque-baixo' : '' ?>">
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= $p['quantidade'] ?> unid.</td>
                                <td>R$ <?= number_format($p['preco_venda'], 2, ',', '.') ?></td>
                                <td>
                                    <a href="registrar_entrada.php?sku=<?= urlencode($p['nome']) ?>" class="btn btn-amarelo">📥 Entrada</a>
                                    <a href="registrar_saida.php?sku=<?= urlencode($p['nome']) ?>" class="btn btn-verde">📤 Saída</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>