<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberia King's Cut | Cadastro</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/style.css">
</head>
<body>
    <div id="fundo-image">
        <main id="card" class="cadastro">
            <div id="logo-image"></div>
            <h1 id="titulo"> Crie sua conta <span class="material-symbols-outlined">content_cut</span>
            </h1>
            <form method="post" action="recebe_cadastro.php" onsubmit="return validarCadastro()">
                <div class="campo">
                    <span class="material-symbols-outlined">person</span>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
                </div>
                <div class="campo">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="email" id="email" placeholder="Digite seu e-mail" autocomplete="email" required>
                </div>
                <div class="campo">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="confirmar_email" id="confirmar_email" placeholder="Confirme seu e-mail" required>
                </div>
                <div class="campo">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="new-password" required>
                </div>
                <div class="campo">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Confirme sua senha" required>
                </div>
                <button type="submit">Cadastrar</button>
                <p class="link-login">Já possui conta?<a href="login.php">Entrar</a>
                </p>
            </form>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>