<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📤 Registrar Saída - Dois Irmãos</title>
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
        <h1>📤 Registrar Saída de Produto</h1>

        <form action="processar_saida.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" required list="produtos" autocomplete="off">
                <datalist id="produtos">
                    <?php
                    $stmt = $pdo->query("SELECT DISTINCT nome FROM produtos ORDER BY nome");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='" . htmlspecialchars($row['nome']) . "'>";
                    }
                    ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade Vendida:</label>
                <input type="number" name="quantidade" id="quantidade" min="1" required>
            </div>
            <div class="form-group" style="justify-content: center; gap: 10px;">
                <button type="submit" class="btn btn-verde">📤 Registrar Saída</button>
                <a href="index.php" class="btn btn-amarelo">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>