<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexao.php");

$sql = "SELECT * FROM agendamentos ORDER BY data_agendada, horario";
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #1C1C1A;
            color: #B6A347;
        }

        a {
            text-decoration: none;
            margin: 0 5px;
        }
    </style>
</head>
<body>

    <h1>Lista de Agendamentos</h1>

    <p>
        <a href="cadastrar.php">Novo Agendamento</a> |
        <a href="../dashboard.php">Voltar ao Painel</a>
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