<?php
include("conexao.php");

// Recebendo dados do formulário
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$confirmar_email = trim($_POST['confirmar_email']);
$senha = $_POST['senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Verifica se os e-mails coincidem
if ($email != $confirmar_email) {
    echo "<script>
            alert('Os e-mails não coincidem.');
            window.location.href = 'cadastro.php';
          </script>";
    exit();
}

// Verifica se as senhas coincidem
if ($senha != $confirmar_senha) {
    echo "<script>
            alert('As senhas não coincidem.');
            window.location.href = 'cadastro.php';
          </script>";
    exit();
}

// Verifica se o e-mail já existe
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>
            alert('Este e-mail já está cadastrado.');
            window.location.href = 'cadastro.php';
          </script>";
    exit();
}

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Insere usuário
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    echo "<script>
            alert('Cadastro realizado com sucesso!');
            window.location.href = 'login.php';
          </script>";
    exit();
}
?>