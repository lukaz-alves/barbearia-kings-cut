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

    $sql = "INSERT INTO agendamentos 
            (cliente, servico, data_agendada, horario, valor)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param(
        "ssssd",
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
    <title>Novo Agendamento</title>
</head>
<body>
    <h1>Novo Agendamento</h1>
    <form method="post">
        <p>
            <label>Cliente:</label><br>
            <input
                type="text"
                name="cliente"
                value="<?php echo $_SESSION['nome_usuario']; ?>"
                required
            >
        </p>
        <p>
            <label>Serviço:</label><br>
            <select name="servico" id="servico" onchange="atualizarValor()" required>
                <option value="">Selecione</option>
                <option value="Cabelo" data-valor="30.00">Cabelo</option>
                <option value="Barba" data-valor="20.00">Barba</option>
                <option value="Cabelo e Barba" data-valor="50.00">
                    Cabelo e Barba
                </option>
            </select>
        </p>
        <p>
            <label>Data:</label><br>
            <input type="date" name="data_agendada" required>
        </p>
        <p>
            <label>Horário:</label><br>
            <input type="time" name="horario" required>
        </p>
        <p>
            <label>Valor (R$):</label><br>
            <input type="text" name="valor" id="valor" readonly>
        </p>
        <button type="submit">Agendar</button>
    </form>
    <p>
        <a href="listar.php">Ver agendamentos</a>
    </p>
    <p>
        <a href="../dashboard.php">Voltar ao Painel</a>
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