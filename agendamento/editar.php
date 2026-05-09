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

// Atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = trim($_POST['cliente']);
    $servico = $_POST['servico'];
    $data_agendada = $_POST['data_agendada'];
    $horario = $_POST['horario'];
    $valor = $_POST['valor'];

    $sql = "UPDATE agendamentos
            SET cliente = ?, servico = ?, data_agendada = ?, horario = ?, valor = ?
            WHERE id = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param(
        "ssssdi",
        $cliente,
        $servico,
        $data_agendada,
        $horario,
        $valor,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Agendamento atualizado com sucesso!');
                window.location.href = 'listar.php';
              </script>";
        exit();
    }
}

// Busca dados atuais
$sql = "SELECT * FROM agendamentos WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    header("Location: listar.php");
    exit();
}

$agendamento = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
</head>
<body>

    <h1>Editar Agendamento</h1>

    <form method="post">

        <p>
            <label>Cliente:</label><br>
            <input type="text" name="cliente"
                   value="<?php echo $agendamento['cliente']; ?>" required>
        </p>

        <p>
            <label>Serviço:</label><br>
            <select name="servico" id="servico" onchange="atualizarValor()" required>
                <option value="Cabelo"
                    <?php if ($agendamento['servico'] == 'Cabelo') echo 'selected'; ?>
                    data-valor="30.00">Cabelo</option>

                <option value="Barba"
                    <?php if ($agendamento['servico'] == 'Barba') echo 'selected'; ?>
                    data-valor="20.00">Barba</option>

                <option value="Cabelo e Barba"
                    <?php if ($agendamento['servico'] == 'Cabelo e Barba') echo 'selected'; ?>
                    data-valor="50.00">Cabelo e Barba</option>
            </select>
        </p>

        <p>
            <label>Data:</label><br>
            <input type="date" name="data_agendada"
                   value="<?php echo $agendamento['data_agendada']; ?>" required>
        </p>

        <p>
            <label>Horário:</label><br>
            <input type="time" name="horario"
                   value="<?php echo substr($agendamento['horario'], 0, 5); ?>" required>
        </p>

        <p>
            <label>Valor:</label><br>
            <input type="text" name="valor" id="valor"
                   value="<?php echo $agendamento['valor']; ?>" readonly>
        </p>

        <button type="submit">Salvar Alterações</button>

    </form>

    <p><a href="listar.php">Voltar</a></p>

    <script>
        function atualizarValor() {
            const select = document.getElementById('servico');
            const option = select.options[select.selectedIndex];
            const valor = option.getAttribute('data-valor') || '';

            document.getElementById('valor').value = valor;
        }
    </script>

</body>
</html>