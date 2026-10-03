<?php
require "../infra/conexao.php";

$categorias = ["Bebê", "Blocos de montar", "Bonecas e pelúcias", "Educativo", "Jogos de tabuleiro", "Quebra-cabeça", "Veículos", "Ar livre"];
$faixas = ["0-2 anos", "3-5 anos", "6-8 anos", "9-11 anos", "12+ anos"];

$erros = [];

if (isset($_POST['editar'])) {
    $id = (int) $_POST['id'];
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $faixa_etaria = trim($_POST['faixa_etaria']);
    $preco = trim($_POST['preco']);
    $quantidade = trim($_POST['quantidade']);

  
if ($nome == "") {
    $erros[] = "Informe o nome do brinquedo.";
}

if ($categoria == "") {
    $erros[] = "Selecione uma categoria.";
}

if ($faixa_etaria == "") {
    $erros[] = "Selecione uma faixa etária.";
}

if ($preco == "" || $preco < 0) {
    $erros[] = "Informe um preço válido.";
}

if ($quantidade == "" || $quantidade < 0) {
    $erros[] = "Informe uma quantidade em estoque válida.";
}

    if (count($erros) == 0) {
        $sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $preco = (float) $preco;
        $quantidade = (int) $quantidade;

        $stmt->bind_param("sssdii", $nome, $categoria, $faixa_etaria, $preco, $quantidade, $id);

        if ($stmt->execute()) {
            header("Location: listar-brinquedo.php");
            exit;
        } else {
            $erros[] = "Erro ao atualizar o brinquedo. Tente novamente.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Brinquedo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-4">
    <h1 class="mb-4">Editar Brinquedo</h1>

    <?php if (count($erros) > 0) { ?>
        <div class="alert alert-danger">
            <?php foreach ($erros as $erro) { echo "<div>$erro</div>"; } ?>
        </div>
    <?php } ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($nome); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria" class="form-select">
                <option value="">Selecione</option>
                <?php foreach ($categorias as $opcao) { ?>
                    <option value="<?php echo $opcao; ?>" <?php if ($categoria == $opcao) echo "selected"; ?>><?php echo $opcao; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Faixa Etária</label>
            <select name="faixa_etaria" class="form-select">
                <option value="">Selecione</option>
                <?php foreach ($faixas as $opcao) { ?>
                    <option value="<?php echo $opcao; ?>" <?php if ($faixa_etaria == $opcao) echo "selected"; ?>><?php echo $opcao; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço (R$)</label>
            <input type="number" name="preco" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($preco); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade em Estoque</label>
            <input type="number" name="quantidade" class="form-control" min="0" value="<?php echo htmlspecialchars($quantidade); ?>">
        </div>

        <button type="submit" name="editar" class="btn btn-primary">Salvar Alterações</button>
        <a href="listar-brinquedo.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>