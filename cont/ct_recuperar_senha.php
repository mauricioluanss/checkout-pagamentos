<?php
/**
 * Script para realizar a recuperação de senha do usuário. Ele gera uma senha aleatória.
 * o script é acionado pelo formulário de 'vi_recueperacao_senha.html'.
 */

// recebe do formulario o valor do campo 'email'.
$email = $_POST['email'];

// realiza a consulta no banco pra verificar se o email informado está na base.
require_once('../conf/config.php');
$verificacao = $conexao->query("SELECT * FROM usuarios WHERE email='$email'");

// função para realizar a criação da nova senha e salva-la no banco.
function gerarSenhaAleatoria($conexao, $email)
{
	$senha = random_int(100000, 9999999); //gera um numero aleatório como senha.
	$conexao->query("UPDATE usuarios SET senha='$senha' WHERE email='$email'");
	echo "
			<script>
				alert('Sua senha temporária é: $senha. Voltando para a tela de login.');
				window.location.href = '../login.html';
			</script>";
}

// validação do retorno da consulta no banco. Se houver registro válido, chama a função 'gerarSenhaAleatoria'.
// Se não encontrar registro, retorna mensagem informando que o email não existe na base e volta para página.
if ($verificacao->num_rows > 0) {
	gerarSenhaAleatoria($conexao, $email);
} else {
	echo "
			<script>
				alert('O $email não foi encontrado na base de dados.');
				window.location.href = '../view/vi_recuperar_senha.html'
			</script>";
}

$conexao->close();
?>