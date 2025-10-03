<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - Dois Irmãos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Logo Distribuidora Dois Irmãos">
    </div>

    <div class="nav">
        <a href="index.php">🏠 Início</a>
    </div>

    <div class="container">
        <h1>➕ Cadastrar Novo Produto</h1>

        <form action="salvar_produto.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="preco_venda">Preço de Venda (R$):</label>
                <input type="number" step="0.01" name="preco_venda" id="preco_venda" required>
            </div>
            <div class="form-group">
                <label for="estoque_minimo">Estoque Mínimo (opcional):</label>
                <input type="number" name="estoque_minimo" id="estoque_minimo" value="0" min="0">
            </div>
            <div class="form-group" style="justify-content: center; gap: 10px;">
                <button type="submit" class="btn btn-verde">💾 Salvar Produto</button>
                <a href="index.php" class="btn btn-amarelo">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>