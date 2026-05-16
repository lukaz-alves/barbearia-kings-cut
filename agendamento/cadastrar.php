<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

include("../conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = trim($_POST['cliente']);
    $servico = $_POST['servico'];
    $data_agendada = $_POST['data_agendada'];
    $horario = $_POST['horario'];
    $valor = $_POST['valor'];

    $sql_verifica = "SELECT id
                     FROM agendamentos
                     WHERE data_agendada = ? AND horario = ?";

    $stmt_verifica = $conexao->prepare($sql_verifica);
    $stmt_verifica->bind_param("ss", $data_agendada, $horario);
    $stmt_verifica->execute();
    $resultado_verifica = $stmt_verifica->get_result();

    if ($resultado_verifica->num_rows > 0) {
        echo "<script>
                alert('Este horário já está ocupado.');
                window.history.back();
              </script>";
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'];

$sql = "INSERT INTO agendamentos
        (id_usuario, cliente, servico, data_agendada, horario, valor)
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param(
        "issssd",
        $id_usuario,
        $cliente,
        $servico,
        $data_agendada,
        $horario,
        $valor
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Agendamento realizado com sucesso!');
                window.location.href = 'listar.php';
            </script>";
        exit();
    } else {
        echo "<script>
                alert('Erro ao realizar agendamento.');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/style-cadastrar.css">
    <title>Agendamento</title>
</head>
<body>
    <nav>
        <img class="logo" src="../src/images/logo.jpeg" alt="logo do perfil">
        <h1>Agendar hórario</h1>
    </nav>
    <form method="post">
        <p>
            <label>Cliente:</label><br>
            <input class="caixinha"
                type="text"
                name="cliente"
                value="<?php echo $_SESSION['nome_usuario']; ?>"
                required
            >
        </p>
        <p>
            <label>Serviço:</label><br>
            <select class="caixinha" name="servico" id="servico" onchange="atualizarValor()" required>
                <option value="">Selecione</option>
                <option value="Cabelo" data-valor="30.00">Cabelo</option>
                <option value="Barba" data-valor="30.00">Barba</option>
                <option value="Cabelo e Barba" data-valor="50.00">
                    Cabelo e Barba
                </option>
            </select>
        </p>
        <p>
            <label>Data:</label><br>
            <input class="caixinha" type="date" name="data_agendada" required>
        </p>
        <p>
            <label>Horário:</label><br>
            <select class="caixinha" name="horario" required>
                <option value="">Selecione um horário</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
            </select>
        </p>
        <p>
            <label>Valor (R$):</label><br>
            <input class="caixinha" type="text" name="valor" id="valor" readonly>
        </p>
        <button type="submit">Agendar</button>
    </form>
    <p class="link">
        <a href="listar.php">Ver agendamentos</a>
    </p>
    <p class="link">
        <a href="../dashboard.php">Voltar ao painel</a>
    </p>
    
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