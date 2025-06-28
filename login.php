<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conectadb.php');
    include('func.php');

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    $senha = criptografa($senha);
   
    $sql = "SELECT COUNT(*) FROM tb_usuario WHERE S_UNM_USUARIO = '$usuario'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_fetch_assoc($result);
 
    // Usuário não existe
    if ($count['COUNT(*)'] == 0) {
        header('Location: login.php?msg=Usuário ou senha incorreto!');
        exit();
    }
    
    $sql = " SELECT COUNT(*) FROM tb_usuario WHERE S_UNM_USUARIO = '$usuario' AND S_PW_USUARIO = '$senha'";
    $result = mysqli_query($link, $sql);
   
    while ($tbl = mysqli_fetch_array($result)) {
        $contagem = $tbl[0];
    }
 
    if ($contagem == 0) {
        // Usuário ou senha incorreto
        header('Location: login.php?msg=E-mail%20ou%20Senha%20incorreto(a)!');
        exit();
    }
    // Senha e usuário correto
    $sql = " SELECT I_COD_USUARIO, S_UNM_USUARIO FROM tb_usuario WHERE S_UNM_USUARIO = '$usuario' AND S_PW_USUARIO = '$senha' ";
    $result = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($result)) {
        $id = $tbl[0];
        $nome = $tbl[1];
    }
    session_start();
    $_SESSION['I_COD_CLIENTE'] = $id;
    $_SESSION['S_NM_CLIENTE'] = $nome;
    header('Location: index.php');
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
    <?php
    if (isset($_GET['msg'])) {
        echo ('<p id="msg_error">' . $_GET['msg'] . '</p>');
    }
    ?>
 
    <form action="login.php" method="post">
        <h2>Faça Login na sua conta</h2>
        <label for="usuario">E-mail:</label>
        <input type="usuario" id="usuario" name="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <?php
        echo ('<p>Crie o seu Cadastro <a href="cadastrausuario.php">Clique aqui</a>.</p>');   
        ?>
        <?php
        if (isset($_GET['msg'])) {
        echo ('<p>Esqueceu a senha? <a href="recupera.php">Clique aqui</a>.</p>');
        }
        ?>
        <br>
        <input type="submit" value="Entrar">
        <img src="imgs/feedcatch.png" alt="logo da marca FeedCatch">
    </form>
<div id="corpo">
    <h1>Quem somos?</h1>

    <p>A FeedCatch é uma empresa B2B que se destaca no mercado por oferecer uma análise detalhada e estratégica das avaliações de clientes para outras empresas. Nossa essência está em transformar a opinião dos consumidores em insights poderosos que direcionam o crescimento e a melhoria contínua de nossos parceiros de negócios.</p>

    <p>Fundada com a visão de que o feedback dos clientes é uma peça-chave para o sucesso empresarial, a FeedCatch utiliza uma combinação de tecnologia avançada e expertise humana para extrair o máximo valor das avaliações online. Nossos analistas são capacitados para utilizar um sistema sofisticado de feedback que permite uma análise profunda e multifacetada dos dados coletados.</p>

    <p>Este sistema é a espinha dorsal de nossas operações, permitindo a captura de avaliações em múltiplas plataformas e a aplicação de técnicas de processamento de linguagem natural para discernir sentimentos, tendências e pontos críticos. Através dessa análise, ajudamos nossos clientes a compreender a percepção de sua marca, a eficácia de seus produtos e serviços, e a identificar oportunidades de melhoria.</p>

    <p>Na FeedCatch, entendemos que cada avaliação é única e carrega consigo a chance de aprimorar a experiência do cliente. Por isso, trabalhamos incansavelmente para oferecer um serviço que não só compila dados, mas também os interpreta de forma a gerar ações concretas. A nossa abordagem permite que as empresas façam ajustes informados, fortaleçam sua reputação e construam uma relação de confiança com seus consumidores.</p>

    <p>Ao optar pela FeedCatch, sua empresa embarca em uma jornada de descoberta e evolução, munida de informações precisas e relevantes sobre o que seus clientes realmente pensam. Estamos aqui para garantir que cada voz seja ouvida e que cada comentário contribua para o sucesso e a excelência de sua marca no competitivo cenário digital atual.</p>
</div>
</body>
 
</html>
 