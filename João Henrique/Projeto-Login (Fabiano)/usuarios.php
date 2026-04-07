<?php
require_once("conexao.php");

$acao = $_GET['acao'] ?? 'listar';
$erro = "";
$sucesso = "";

// SALVAR
if ($acao == 'salvar') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);
    $senhaInput = $_POST['senha'];

    // VALIDAÇÕES
    if (empty($nome) || empty($email) || empty($senhaInput) || empty($mensagem)) {
        $erro = "Preencha todos os campos!";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } 
    elseif (strlen($mensagem) > 250) {
        $erro = "A mensagem deve ter no máximo 250 caracteres!";
    } 
    else {
      
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $erro = "Este e-mail já está cadastrado!";
        } else {
            $senha = password_hash($senhaInput, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $senha, $mensagem]);

            $sucesso = "Usuário cadastrado com sucesso!";
        }
    }
}

// EXCLUIR
if ($acao == 'excluir') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: usuarios.php");
    exit;
}

// EDITAR
if ($acao == 'editar') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// UPDATE
if ($acao == 'update') {
    $id = $_POST['id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);

    if (empty($nome) || empty($email) || empty($mensagem)) {
        $erro = "Preencha todos os campos!";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } 
    elseif (strlen($mensagem) > 250) {
        $erro = "A mensagem deve ter no máximo 250 caracteres!";
    } 
    else {
        $stmt = $conn->prepare("UPDATE usuarios SET nome=?, email=?, mensagem=? WHERE id=?");
        $stmt->execute([$nome, $email, $mensagem, $id]);

        header("Location: usuarios.php");
        exit;
    }
}

// LISTAR
$stmt = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="usuarios.css">
</head>
<body>

<div class="container">

    <h1>Sistema de Usuários</h1>

    <div class="menu">
        <a href="usuarios.php" class="btn">Cadastro</a>
        <a href="usuarios.php?view=lista" class="btn">Consultar</a>
    </div>

    <?php
    $view = $_GET['view'] ?? 'cadastro';
    ?>

    <!-- ================= CADASTRO ================= -->
    <?php if ($view == 'cadastro'): ?>

        <h2><?= isset($usuario) ? "Editar Usuário" : "Cadastrar Usuário" ?></h2>

        <?php if (!empty($erro)): ?>
            <div class="alert erro"><?= $erro ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert sucesso"><?= $sucesso ?></div>
        <?php endif; ?>

        <form method="POST" action="usuarios.php?acao=<?= isset($usuario) ? 'update' : 'salvar' ?>" class="user-form">
            
            <input type="hidden" name="id" value="<?= $usuario['id'] ?? '' ?>">

            <input type="text" name="nome" placeholder="Nome"
                value="<?= $usuario['nome'] ?? '' ?>" required>

            <input type="email" name="email" placeholder="Email"
                value="<?= $usuario['email'] ?? '' ?>" required>
                
            <textarea 
                name="mensagem" 
                maxlength="250" 
                placeholder="Mensagem (máx. 250 caracteres)" 
                required><?= $usuario['mensagem'] ?? '' ?></textarea>

            <?php if (!isset($usuario)): ?>
                <input type="password" name="senha" placeholder="Senha" required>
            <?php endif; ?>

            <button type="submit">Salvar</button>
        </form>

    <?php endif; ?>

    <!-- ================= CONSULTA ================= -->
    <?php if ($view == 'lista'): ?>

        <h2>Consulta de Usuários</h2>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Mensagem</th>
                    <th>Ações</th>
                </tr>

                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td class="mensagem-coluna"><?= htmlspecialchars($u['mensagem']) ?></td>
                    <td class="acoes">
                        <a class="link-edit" href="?acao=editar&id=<?= $u['id'] ?>">Editar</a>
                        <a class="link-delete" href="?acao=excluir&id=<?= $u['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>

    <?php endif; ?>

</div>

</body>
</html>
