<?php
require "../infra/conexao.php";

$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade FROM brinquedos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Brinquedos</title>
</head>
<body>

    <h1>Brinquedos Cadastrados</h1>

    <p>
        <a href="cadastrar-brinquedo.php">Cadastrar Novo Brinquedo</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Faixa Etária</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && $resultado->num_rows > 0) { ?>
                <?php while ($linha = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $linha['id']; ?></td>
                        <td><?php echo htmlspecialchars($linha['nome']); ?></td>
                        <td><?php echo htmlspecialchars($linha['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($linha['faixa_etaria']); ?></td>
                        <td>R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $linha['quantidade']; ?></td>
                        <td>
                            <a href="editar-brinquedo.php?id=<?php echo $linha['id']; ?>">Editar</a> | 
                            <a href="excluir.php?id=<?php echo $linha['id']; ?>" onclick="return confirm('Excluir este brinquedo?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7">Nenhum brinquedo encontrado.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>