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
    <title>Login</title>
    <style>
        /* Estilo para a página */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            /* Fundo escuro */
            color: #e0e0e0;
            /* Texto claro */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Estilo para o título */
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #8b0000;
            
        }

        /* Estilo para o formulário */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Garante alinhamento central */
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        /* Estilo para os rótulos */
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #ffffff;
        }

        /* Ajuste para os campos de entrada */
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"],
        select {
            width: calc(100% - 20px);
            /* Ajusta a largura para caber no formulário */
            max-width: 480px;
            /* Limita a largura máxima */
            padding: 10px;
            margin: 0 auto 15px;
            /* Centraliza os campos */
            border: 1px solid #333;
            border-radius: 4px;
            background-color: #2c2c2c;
            color: #ffffff;
            box-sizing: border-box;
            /* Garante que o padding não afeta o tamanho */
        }

        /* Ajuste para o botão de envio */
        input[type="submit"] {
            width: calc(100% - 20px);
            /* Garante que o botão siga o mesmo padrão */
            max-width: 480px;
            padding: 10px;
            margin: 10px auto 0;
            /* Centraliza o botão */
            border: none;
            border-radius: 4px;
            background-color: #8b0000;
            color: #121212;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #8b0000;
            /* Roxo mais escuro */
        }

        /* Espaçamento entre os elementos */
        form>*:not(:last-child) {
            margin-bottom: 10px;
        }

        #msg_error {
            font-weight: bolder;
            color: red;
            font-size: 1.5vw;
        }
         /* Botões */
         button {
            padding: 10px 20px;
            
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .confirm-btn {
            background-color: #8b0000;
            color: #121212;
        }

        .confirm-btn:hover {
            background-color:rgb(63, 0, 0);
        }

        .cancel-btn {
            background-color: #8b0000;
            color: #121212;
        }

        .cancel-btn:hover {
            background-color:rgb(63, 0, 0);
        }
    </style>
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
 