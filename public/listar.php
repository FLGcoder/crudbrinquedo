<?php
require "../infra/conexao.php";

$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade FROM brinquedos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão de Brinquedos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Brinquedos</h1>
        <a href="cadastrar-brinquedo.php" class="btn btn-success">+ Cadastrar Brinquedo</a>
    </div>

    <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Faixa Etária</th>
                <th>Preço (R$)</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && $resultado->num_rows > 0) { ?>
                <?php while ($brinquedo = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $brinquedo['id']; ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['nome']); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($brinquedo['faixa_etaria']); ?></td>
                        <td>R$ <?php echo number_format($brinquedo['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $brinquedo['quantidade']; ?></td>
                        <td>
                            <a href="editar-brinquedo.php?id=<?php echo $brinquedo['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir.php?id=<?php echo $brinquedo['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhum brinquedo cadastrado.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
</body>
</html>