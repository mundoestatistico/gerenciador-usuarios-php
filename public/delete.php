<?php

require_once __DIR__ . '/../../config/database.php';

if (!isset($_GET['id'])) {
    header('Location: list.php?error=ID de usuário não fornecido.');
    exit();
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    if ($stmt->affected_rows > 0) {
        header('Location: list.php?success=Usuário excluído com sucesso!');
    } else {
        header('Location: list.php?error=Usuário não encontrado.');
    }

} else {

    header(
        'Location: list.php?error=' .
        urlencode('Erro ao excluir usuário: ' . $stmt->error)
    );
}

$stmt->close();
$conn->close();

exit();