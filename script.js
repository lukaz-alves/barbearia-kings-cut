function validarCadastro() {
    const email = document.getElementById('email').value;
    const confirmarEmail = document.getElementById('confirmar_email').value;
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;

    if (email !== confirmarEmail) {
        alert('Os e-mails não coincidem.');
        return false;
    }

    if (senha !== confirmarSenha) {
        alert('As senhas não coincidem.');
        return false;
    }

    return true;
}