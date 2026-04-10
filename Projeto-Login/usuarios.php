<?php
require_once("conexao.php");

$acao = $_GET['acao'] ?? 'listar';
$view = $_GET['view'] ?? 'cadastro';
$erro = "";
$sucesso = "";
$usuario = null;

// FUNÇÕES AUXILIARES

function senhaForte($senha) {
    return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $senha);
}

function validarDadosUsuario($nome, $email, $mensagem, $senhaInput) {
    if (empty($nome) || empty($email) || empty($mensagem) || empty($senhaInput)) {
        return "Preencha todos os campos!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "E-mail invalido!";
    }

    if (strlen($mensagem) > 250) {
        return "A mensagem deve ter no maximo 250 caracteres!";
    }

    if (!senhaForte($senhaInput)) {
        return "A senha deve ter no minimo 8 caracteres, letra maiúscula, numero e caractere especial.";
    }

    return "";
}

function emailJaCadastrado($conn, $email) {
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->rowCount() > 0;
}

// CADASTRAR USUARIO

if ($acao === 'salvar') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $senhaInput = $_POST['senha'] ?? '';

    $erro = validarDadosUsuario($nome, $email, $mensagem, $senhaInput);

    if (empty($erro)) {
        if (emailJaCadastrado($conn, $email)) {
            $erro = "Este e-mail ja esta cadastrado!";
        } else {
            $senhaHash = password_hash($senhaInput, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $senhaHash, $mensagem]);
            $sucesso = "Usuario cadastrado com sucesso!";
        }
    }
}

// EXCLUIR USUARIO

if ($acao === 'excluir') {
    $id = $_GET['id'] ?? null;

    if (!empty($id)) {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: usuarios.php");
    exit;
}

// CARREGAR EDIÇÃO

if ($acao === 'editar') {
    $id = $_GET['id'] ?? null;

    if (!empty($id)) {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}

// ATUALIZAR USUARIO

if ($acao === 'update') {
    $id = $_POST['id'] ?? null;
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');
    $senhaInput = $_POST['senha'] ?? '';

    $erro = validarDadosUsuario($nome, $email, $mensagem, $senhaInput);

    if (empty($erro) && !empty($id)) {
        $senhaHash = password_hash($senhaInput, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, mensagem = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $senhaHash, $mensagem, $id]);
    }

    if (empty($erro)) {
        header("Location: usuarios.php");
        exit;
    }
}

// CONSULTA/LISTA

$stmt = $conn->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuarios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="usuarios.css">
</head>
<body>

<div class="container">

    <div class="hero">
        <span class="hero-badge">Painel Administrativo</span>
        <h1>Sistema de Usuarios</h1>
        <p class="hero-text">Gerencie cadastros com uma interface organizada, moderna e profissional.</p>
    </div>

    <div class="menu">
        <a href="usuarios.php" class="btn">Cadastro</a>
        <a href="usuarios.php?view=lista" class="btn">Consultar</a>
    </div>

    <?php if ($view == 'cadastro'): ?>

        <div class="section-heading">
            <h2><?= isset($usuario) ? "Editar Usuario" : "Cadastrar Usuario" ?></h2>
            <p>
                <?= isset($usuario) ? "Atualize os dados do usuario selecionado." : "Preencha os campos abaixo para adicionar um novo usuario ao sistema." ?>
            </p>
        </div>

        <?php if (!empty($erro)): ?>
            <div class="alert erro"><?= $erro ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="alert sucesso"><?= $sucesso ?></div>
        <?php endif; ?>

        <form method="POST" action="usuarios.php?acao=<?= isset($usuario) ? 'update' : 'salvar' ?>" class="user-form">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?? '' ?>">

            <input type="text" name="nome" placeholder="Nome" value="<?= $usuario['nome'] ?? '' ?>" required>

            <input type="email" name="email" placeholder="Email" value="<?= $usuario['email'] ?? '' ?>" required>

            <textarea name="mensagem" maxlength="250" placeholder="Mensagem (max. 250 caracteres)" required><?= $usuario['mensagem'] ?? '' ?></textarea>

            <input
                id="senha"
                type="password"
                name="senha"
                minlength="8"
                pattern="(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}"
                title="Use no minimo 8 caracteres, incluindo letra maiúscula, numero e caractere especial."
                placeholder="Senha"
                required
            >

            <div class="password-tools">
                <label for="mostrar-senha" class="show-password-label">
                    <input type="checkbox" id="mostrar-senha">
                    Mostrar senha
                </label>
                <small class="password-hint">Requisito de senha: minimo 8 caracteres, letra maiúscula, numero e caractere especial.</small>
            </div>

            <button type="submit">Salvar</button>
        </form>

    <?php endif; ?>

    <?php if ($view == 'lista'): ?>

        <div class="section-heading">
            <h2>Consulta de Usuarios</h2>
            <p>Visualize os registros cadastrados e acesse rapidamente as acoes de edicao e exclusao.</p>
        </div>

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

<footer class="site-footer">
    <div class="site-footer-content">
        <p>Desenvolvido por <strong>João Henrique</strong> e <strong>Daniel Galvão</strong></p>
        <span>Sistema com identidade visual profissional para ambiente administrativo.</span>
    </div>
</footer>

<script>
const inputSenha = document.getElementById("senha");
const mostrarSenha = document.getElementById("mostrar-senha");

if (inputSenha && mostrarSenha) {
    mostrarSenha.addEventListener("change", function () {
        inputSenha.type = this.checked ? "text" : "password";
    });
}
</script>

</body>
</html>


