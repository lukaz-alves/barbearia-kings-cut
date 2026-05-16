<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberia King's Cut | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/style.css">
</head>
<body>
    <div id="fundo-image">
        <main id="card">
            <div id="logo-image"></div>
            <h1 id="titulo">Onde você é tratado como REI <span class="material-symbols-outlined">crown</span></h1>
            <form method="post" action="recebe_login.php">
                <div class="campo">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="email" id="email" required size="25" autocomplete="email" placeholder="Digite seu e-mail">
                </div>
                <div class="campo">
                    <span class="material-symbols-outlined">key</span>
                    <input type="password" name="senha" id="senha" required size="25" autocomplete="current-password" placeholder="Digite sua senha">
                </div>

                <button type="submit" name="acao" value="login">Entrar</button>
                <p class="link">Não possui conta? <a href="cadastro.php">Cadastre-se</a></p>

                <a href="#" class="botao">
                    Esqueci a senha <span class="material-symbols-outlined">email</span>
                </a>
            </form>
        </main>
    </div>
</body>
</html>