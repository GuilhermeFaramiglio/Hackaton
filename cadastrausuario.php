<?php
include('utils/conectadb.php');
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('func.php');
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['confirmar_senha'];
    $tipoUsuario  = intval($_POST['tipo_usuario']);

    $senha = criptografa($senha); // Apenas uma vez!
   
    $sql = " INSERT INTO tb_usuario (S_UNM_USUARIO, S_PW_USUARIO, S_NOME_EMPRESA)
     VALUES ('$nome', '$senha', $tipoUsuario); "; // comando
    $result = mysqli_query($link, $sql);
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
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
        <br>
        <label>INICIAR USUARIO COMO:</label>
            <div class='rbcliente'>   
                <input type="radio" name="tipo_usuario" id="externo" value="1" checked><label>Cliente Externo</label>
                <br>
                <input type="radio" name="tipo_usuario" id="inativo" value="0"><label>Funcionario Interno</label>
            </div>
        <input type="Submit" value="Cadastrar">
    </form>
</body>
 
</html>
 