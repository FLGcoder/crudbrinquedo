<?php
require "../infra/conexao.php";

$erros = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $faixa_etaria = trim($_POST['faixa_etaria']);
    $preco = trim($_POST['preco']);
    $quantidade = trim($_POST['quantidade']);

    if ($nome == "") {
        $erros[] = "Informe o nome.";
    }
    if ($categoria == "") {
        $erros[] = "Informe a categoria.";
    }
    if ($faixa_etaria == "") {
        $erros[] = "Informe a faixa etaria.";
    }
    if ($preco == "" || $preco < 0) {
        $erros[] = "Informe um preco valido.";
    }
    if ($quantidade == "" || $quantidade < 0) {
        $erros[] = "Informe uma quantidade valida.";
    }

    if (count($erros) == 0) {
        $sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $preco_float = (float) $preco;
        $qtd_int = (int) $quantidade;

        $stmt->bind_param("sssdii", $nome, $categoria, $faixa_etaria, $preco_float, $qtd_int, $id);

        if ($stmt->execute()) {
            header("Location: listar-brinquedo.php");
            exit;
        } else {
            $erros[] = "Erro ao atualizar no banco.";
        }
    }
} else {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    $sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade FROM brinquedos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $brinquedo = $stmt->get_result()->fetch_assoc();

    if (!$brinquedo) {
        header("Location: listar-brinquedo.php");
        exit;
    }

    $nome = $brinquedo['nome'];
    $categoria = $brinquedo['categoria'];
    $faixa_etaria = $brinquedo['faixa_etaria'];
    $preco = $brinquedo['preco'];
    $quantidade = $brinquedo['quantidade'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
</head>
<body>

    <h2>Editar Brinquedo</h2>

    <?php if (count($erros) > 0) { ?>
        <ul style="color: red;">
            <?php foreach ($erros as $erro) { ?>
                <li><?php echo $erro; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>

        <label>Categoria:</label><br>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>"><br><br>

        <label>Faixa Etária:</label><br>
        <input type="text" name="faixa_etaria" value="<?php echo htmlspecialchars($faixa_etaria); ?>"><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?php echo htmlspecialchars($preco); ?>"><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>"><br><br>

        <button type="submit">Atualizar</button>
        <a href="listar-brinquedo.php">Voltar</a>
    </form>

</body>
</html>