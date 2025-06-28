<?php
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conndb.php');
    include('func.php');
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['confirmar_senha'];
    $senha = criptografa($senha); // Apenas uma vez!
   
   
    $sql = " INSERT INTO tb_cliente (S_NM_CLIENTE, S_EMAIL_CLIENTE, S_ENDER_CLIENTE, S_CPF_CLIENTE, S_TEL_CLIENTE,
    S_PASS_CLIENTE)
     VALUES ('$nome', '$email', '$endereco', '$cpf', '$telefone', '$senha'); "; // comando
    mysqli_query($conn, $sql);
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php 
    
    if (isset($_GET['msg'])) {
        echo "<script>alert('Login criado com sucesso!');</script>";
    } 
    ?>
    <h1>Cadastro de Usuário</h1>
    <?php
    if (isset($_GET['msg'])) {
        echo ('<p id="msg_error">Erro: ' . $_GET['msg'] . '</p>');
    }
    ?>
 
    <form action="cadastrausuario.php" method="post" autocomplete="off">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" maxlength="100" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" maxlength="50" required>
        <br>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" maxlength="100" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="14" required>
        <br>
        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" maxlength="19" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
        <br>
        <input type="Submit" value="Cadastrar">
 
    </form>
</body>
 
</html>
 