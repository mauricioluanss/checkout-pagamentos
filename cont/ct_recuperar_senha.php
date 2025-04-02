<?php
/** Script pra recuperação de senha do usuário.*/
require_once('../conf/config.php');
//Quis brincar de POO pra ver se dava certo.
class senha {
    public $senha;
    public function __construct($senhaTemporaria) {
        $this->senha = $senhaTemporaria;
    }
    public function getSenha(){
        return $this->senha;
    }
}

$email = $_POST['email'];
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

if ($verificacao->num_rows > 0) {
    gerarSenhaAleatoria($conexao, $email);
}
function gerarSenhaAleatoria($conexao, $email) {
    $senha = new senha(random_int(100000, 9999999));
    $senhaString = $senha->getSenha();
    $conexao->query("UPDATE usuarios SET senha='$senhaString' WHERE email='$email'");

    echo "
    <script>
        alert('Sua senha temporária é: $senhaString');
        window.location.href = '../login.html';
    </script>";
}
$conexao->close();
?>