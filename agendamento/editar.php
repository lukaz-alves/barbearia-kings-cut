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
        WHERE id = ? AND id_usuario = ?";

    $stmt = $conexao->prepare($sql);
    
    $id_usuario = $_SESSION['id_usuario'];
    $stmt->bind_param(
        "ssssdii",
        $cliente,
        $servico,
        $data_agendada,
        $horario,
        $valor,
        $id,
        $id_usuario
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
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM agendamentos
        WHERE id = ? AND id_usuario = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("ii", $id, $id_usuario);
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
    <link rel="stylesheet" href="../src/style-editar.css">
    <style>
        
    </style>
</head>
<body>

    <nav>
        <img class="logo" src="../src/images/logo.jpeg" alt="logo do perfil">
        <h1>Editar Agendamento</h1>
    </nav>

    <form method="post">

        <p>
            <label>Cliente:</label><br>
            <input class="caixinha" type="text" name="cliente"
                   value="<?php echo $agendamento['cliente']; ?>" required>
        </p>

        <p>
            <label>Serviço:</label><br>
            <select class="caixinha" name="servico" id="servico" onchange="atualizarValor()" required>
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
            <input class="caixinha" type="date" name="data_agendada"
                   value="<?php echo $agendamento['data_agendada']; ?>" required>
        </p>

        <p>
            <label>Horário:</label><br>
            <select class="caixinha" name="horario" required>
                <?php
                $horarios = [
                    "09:00", "10:00", "11:00", "12:00",
                    "13:00", "14:00", "15:00", "16:00",
                    "17:00", "18:00"
                ];

                foreach ($horarios as $hora) {
                    $selected = (substr($agendamento['horario'], 0, 5) == $hora)
                        ? "selected"
                        : "";

                    echo "<option value='$hora' $selected>$hora</option>";
                }
                ?>
            </select>
        </p>

        <p>
            <label>Valor:</label><br>
            <input class="caixinha" type="text" name="valor" id="valor"
                   value="<?php echo $agendamento['valor']; ?>" readonly>
        </p>

        <button type="submit">Salvar alterações</button>

    </form>

    <p><a class="link" href="listar.php">Voltar ao agendamento</a></p>

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