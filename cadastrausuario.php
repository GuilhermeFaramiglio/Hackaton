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
 