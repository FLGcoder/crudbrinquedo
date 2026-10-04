<?php
require "../infra/conexao.php";

$erros = [];
$nome = "";
$categoria = "";
$faixa_etaria = "";
$preco = "";
$quantidade = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
        $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $preco_float = (float) $preco;
        $qtd_int = (int) $quantidade;

        $stmt->bind_param("sssdi", $nome, $categoria, $faixa_etaria, $preco_float, $qtd_int);

        if ($stmt->execute()) {
            header("Location: listar-brinquedo.php");
            exit;
        } else {
            $erros[] = "Erro ao cadastrar no banco.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Brinquedo</title>
</head>
<body>

    <h2>Cadastrar Brinquedo</h2>

    <?php if (count($erros) > 0) { ?>
        <ul style="color: red;">
            <?php foreach ($erros as $erro) { ?>
                <li><?php echo $erro; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form method="POST">
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

        <button type="submit">Salvar</button>
        <a href="listar-brinquedo.php">Voltar</a>
    </form>

</body>
</html>