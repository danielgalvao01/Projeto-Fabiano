<?php
session_start();

$erro = $_SESSION['erro'] ?? "";
$dados = $_SESSION['dados'] ?? [];

unset($_SESSION['erro']);
unset($_SESSION['dados']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Cadastro</h2>

    <?php if (!empty($erro)) : ?>
        <div class="erro"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form action="salvar.php" method="POST">

        Nome:
        <input type="text" name="nome" 
        value="<?php echo htmlspecialchars($dados['nome'] ?? ''); ?>">

        Email:
        <input type="text" name="email" 
        value="<?php echo htmlspecialchars($dados['email'] ?? ''); ?>">

        Senha:
        <input type="password" name="senha">

        Mensagem:
        <textarea name="mensagem"><?php echo htmlspecialchars($dados['mensagem'] ?? ''); ?></textarea>

        <button type="submit">Cadastrar</button>

    </form>

</div>

</body>
</html>