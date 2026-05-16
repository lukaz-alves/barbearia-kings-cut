<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexao.php");

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM agendamentos
        WHERE id_usuario = ?
        ORDER BY data_agendada, horario";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="../src/style-listar.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    <h1>Lista de Agendamentos</h1>

    <p>
        <a class="link" href="cadastrar.php">Novo Agendamento</a> |
        <a class="link" href="../dashboard.php">Voltar ao Painel</a>
    </p>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Serviço</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>

        <?php while ($agendamento = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $agendamento['id']; ?></td>
            <td><?php echo $agendamento['cliente']; ?></td>
            <td><?php echo $agendamento['servico']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($agendamento['data_agendada'])); ?></td>
            <td><?php echo substr($agendamento['horario'], 0, 5); ?></td>
            <td>R$ <?php echo number_format($agendamento['valor'], 2, ',', '.'); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $agendamento['id']; ?>">Editar</a>
                |
                <a href="excluir.php?id=<?php echo $agendamento['id']; ?>"
                   onclick="return confirm('Deseja realmente excluir?')">
                    Excluir
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>