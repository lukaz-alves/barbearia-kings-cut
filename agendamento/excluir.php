<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexao.php");

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "DELETE FROM agendamentos WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
            alert('Agendamento excluído com sucesso!');
            window.location.href = 'listar.php';
          </script>";
} else {
    echo "<script>
            alert('Erro ao excluir agendamento.');
            window.location.href = 'listar.php';
          </script>";
}
?>