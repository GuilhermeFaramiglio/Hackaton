<?php
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conndb.php');
    include('func.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $senha = criptografa($senha);
   
    $sql = "SELECT COUNT(*) FROM tb_cliente WHERE S_EMAIL_CLIENTE = '$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($result);
 
    // Usuário não existe
    if ($count['COUNT(*)'] == 0) {
        header('Location: login.php?msg=Usuário ou senha incorreto!');
        exit();
    }
    
    $sql = " SELECT COUNT(*) FROM tb_cliente WHERE S_EMAIL_CLIENTE = '$email' AND S_PASS_CLIENTE = '$senha'";
    echo $sql;
    $result = mysqli_query($conn, $sql);
   
    while ($tbl = mysqli_fetch_array($result)) {
        $contagem = $tbl[0];
    }
 
    if ($contagem == 0) {
        // Usuário ou senha incorreto
        header('Location: login.php?msg=E-mail%20ou%20Senha%20incorreto(a)!');
        exit();
    }
    // Senha e usuário correto
    $sql = " SELECT I_COD_CLIENTE , S_NM_CLIENTE FROM tb_cliente WHERE S_EMAIL_CLIENTE = '$email' AND S_PASS_CLIENTE = '$senha' ";
    $result = mysqli_query($conn, $sql);
    while ($tbl = mysqli_fetch_array($result)) {
        $id = $tbl[0];
        $nome = $tbl[1];
    }
    session_start();
    $_SESSION['I_COD_CLIENTE'] = $id;
    $_SESSION['S_NM_CLIENTE'] = $nome;
    header('Location: principal.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
 
<body>
    <h1>Faça Login na sua conta</h1>
    <?php
    if (isset($_GET['msg'])) {
        echo ('<p id="msg_error">' . $_GET['msg'] . '</p>');
    }
    ?>
 
    <form action="login.php" method="post">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <?php
        echo ('<p>Crie o seu Login<a href="cadastrausuario.php">Clique aqui</a>.</p>');   
        ?>
        <?php
        if (isset($_GET['msg'])) {
        echo ('<p>Esqueceu a senha? <a href="recupera.php">Clique aqui</a>.</p>');
        }
        ?>
        <br>
        <input type="submit" value="Entrar">
    </form>
 
</body>
 
</html>
 