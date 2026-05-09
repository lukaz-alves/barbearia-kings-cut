<?php
session_start();
include("conexao.php");

$email = trim($_POST['email']);
$senha = $_POST['senha'];

$sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['id_usuario'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];

        header("Location: dashboard.php");
        exit();
    }
}

echo "<script>
        alert('E-mail ou senha inválidos.');
        window.location.href = 'login.php';
      </script>";
exit();
?>