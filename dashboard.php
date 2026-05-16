<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="src/style-perfil.css">
</head>
<body>
    <nav>
        <img class="logo" src="src/images/logo.jpeg" alt="logo do perfil">
        <h1>Bem-vindo, <?php echo $_SESSION['nome_usuario']; ?>!</h1>
    </nav>
    
    <p><a href="agendamento/cadastrar.php">Agendar Horário</a></p>
    <p><a href="agendamento/listar.php">Ver Agendamentos</a></p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>