<?php
require "../infra/conexao.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0) {

    $sql = "DELETE FROM brinquedos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("i", $id);
    
    $stmt->execute();
}

header("Location: listar-brinquedo.php");
exit;
?>