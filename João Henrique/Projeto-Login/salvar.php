<?php
session_start();
include("conexao.php");

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";
$_SESSION['dados'] = [
    'nome' => $nome,
    'email' => $email,
    'mensagem' => $mensagem
];

if (empty($nome) || empty($email) || empty($senha) || empty($mensagem)) {
    $_SESSION['erro'] = "Preencha todos os campos!";
    header("Location: index.php");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['erro'] = "Digite um e-mail válido!";
    header("Location: index.php");
    exit;
}

if (strlen($mensagem) > 250) {
    $_SESSION['erro'] = "Mensagem deve ter até 250 caracteres!";
    header("Location: index.php");
    exit;
}

$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION['erro'] = "E-mail já cadastrado!";
    header("Location: index.php");
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $email, $senhaHash, $mensagem);

if ($stmt->execute()) {

    unset($_SESSION['dados']);

    header("Location: sucesso.php?nome=$nome&email=$email&mensagem=$mensagem");
    exit;
} else {
    $_SESSION['erro'] = "Erro ao cadastrar!";
    header("Location: index.php");
    exit;
}