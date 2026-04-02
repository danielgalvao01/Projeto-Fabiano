<?php
$nome = $_GET['nome'] ?? '';
$email = $_GET['email'] ?? '';
$mensagem = $_GET['mensagem'] ?? '';
?>

<link rel="stylesheet" href="style.css">

<div class="sucesso">
    <h2>Cadastro realizado com sucesso!</h2>

    <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Mensagem:</strong> <?php echo htmlspecialchars($mensagem); ?></p>

    <a href="index.php">Voltar</a>
</div>