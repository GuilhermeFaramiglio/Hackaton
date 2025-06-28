<?php


include('utils/conectadb.php');

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    echo "<script>alert('Usuário não logado!');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$where_clauses = [];
$params = [];
$types = '';
$selected_campanhas = !empty($_GET['campanhas']) ? $_GET['campanhas'] : [];

// Filtro por Campanha
if (!empty($selected_campanhas)) {
    $placeholders = implode(',', array_fill(0, count($selected_campanhas), '?'));
    $where_clauses[] = "f.I_COD_CAMPANHA IN ($placeholders)";
    $types .= str_repeat('i', count($selected_campanhas));
    $params = array_merge($params, $selected_campanhas);
}

// Filtro por Produto
if (!empty($_GET['produtos'])) {
    $selected_produtos = $_GET['produtos'];
    $placeholders = implode(',', array_fill(0, count($selected_produtos), '?'));
    $where_clauses[] = "f.I_COD_CAMPANHA IN (SELECT DISTINCT I_COD_CAMPANHA FROM TB_ITENSCAMPANHA WHERE I_COD_PRODUTO IN ($placeholders))";
    $types .= str_repeat('i', count($selected_produtos));
    $params = array_merge($params, $selected_produtos);
}

// Filtro por Sentimento
if (!empty($_GET['sentimentos'])) {
    $selected_sentimentos = $_GET['sentimentos'];
    $placeholders = implode(',', array_fill(0, count($selected_sentimentos), '?'));
    $where_clauses[] = "f.I_SENT_FEEDBACK IN ($placeholders)";
    $types .= str_repeat('i', count($selected_sentimentos));
    $params = array_merge($params, $selected_sentimentos);
}

$where_sql = "";
if (!empty($where_clauses)) {
    $where_sql = " WHERE " . implode(" AND ", $where_clauses);
}

// --- Obter Dados para os Menus de Filtro ---
$campanhas = $link->query("SELECT I_COD_CAMPANHA, S_NM_CAMPANHA FROM TB_CAMPANHA ORDER BY S_NM_CAMPANHA ASC");

// ***** LÓGICA DO FILTRO DE PRODUTOS DEPENDENTE *****
$sql_produtos = "
    SELECT DISTINCT p.I_COD_PRODUTO, p.S_NM_PRODUTO, p.S_TAM_PRODUTO, p.S_COR_PRODUTO 
    FROM TB_PRODUTO p
";
$params_produtos = [];
$types_produtos = '';

// Se houver campanhas selecionadas, filtra os produtos
if (!empty($selected_campanhas)) {
    $placeholders_prod = implode(',', array_fill(0, count($selected_campanhas), '?'));
    $sql_produtos .= " 
        JOIN TB_ITENSCAMPANHA ic ON p.I_COD_PRODUTO = ic.I_COD_PRODUTO
        WHERE ic.I_COD_CAMPANHA IN ($placeholders_prod)
    ";
    $types_produtos = str_repeat('i', count($selected_campanhas));
    $params_produtos = $selected_campanhas;
}
$sql_produtos .= " ORDER BY p.S_NM_PRODUTO ASC, p.S_COR_PRODUTO ASC, p.S_TAM_PRODUTO ASC";

// Executa a consulta de produtos com segurança
$stmt_produtos = $link->prepare($sql_produtos);
$produtos = false;
if ($stmt_produtos) {
    if (!empty($params_produtos)) {
        $stmt_produtos->bind_param($types_produtos, ...$params_produtos);
    }
    $stmt_produtos->execute();
    $produtos = $stmt_produtos->get_result();
}

// --- Obter Contagens de Sentimentos (COM FILTROS) ---
$sentimentos = ['positivo' => 0, 'neutro' => 0, 'negativo' => 0];
$sql_counts = "SELECT I_SENT_FEEDBACK, COUNT(*) as count FROM TB_FEEDBACK f" . $where_sql . " GROUP BY I_SENT_FEEDBACK";
$stmt_counts = $link->prepare($sql_counts);
if ($stmt_counts) {
    if (!empty($params)) {
        $stmt_counts->bind_param($types, ...$params);
    }
    $stmt_counts->execute();
    $result_sentimentos = $stmt_counts->get_result();
    if ($result_sentimentos) {
        while ($row = $result_sentimentos->fetch_assoc()) {
            // Mapeamento correto: 1=Positivo, 0=Neutro, 2=Negativo
            if ($row['I_SENT_FEEDBACK'] == 1) $sentimentos['positivo'] = $row['count'];
            if ($row['I_SENT_FEEDBACK'] == 2) $sentimentos['neutro'] = $row['count'];
            if ($row['I_SENT_FEEDBACK'] == 0) $sentimentos['negativo'] = $row['count'];
        }
    }
}

// --- Obter Lista de Feedbacks (COM FILTROS) ---
$sql_feedbacks = "SELECT f.S_TXT_FEEDBACK, f.S_AUTOR_FEEDBACK, f.DT_FEEDBACK, c.S_NM_CAMPANHA, f.I_SENT_FEEDBACK
    FROM TB_FEEDBACK f
    JOIN TB_CAMPANHA c ON f.I_COD_CAMPANHA = c.I_COD_CAMPANHA" . $where_sql . "
    ORDER BY f.DT_FEEDBACK DESC";

$stmt_feedbacks = $link->prepare($sql_feedbacks);
$feedbacks = false;
if ($stmt_feedbacks) {
    if (!empty($params)) {
        $stmt_feedbacks->bind_param($types, ...$params);
    }
    $stmt_feedbacks->execute();
    $feedbacks = $stmt_feedbacks->get_result();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Feedbacks - FeedCatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/dash.css">
</head>
<body class="bg-gray-900 text-gray-200 font-sans">

    <!-- Header -->
    <header class="bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-comments text-indigo-400 text-2xl"></i>
                    <h1 class="text-xl font-bold ml-3">FeedCatch Dashboard</h1>
                </div>
                <div class="flex items-center">
                    <span class="mr-4"><i class="fas fa-user-circle mr-2"></i><?php echo htmlspecialchars($nomeusuario); ?></span>
                    <a href="login.php" class="text-gray-300 hover:text-white"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Conteudo principal -->
    <main class="container mx-auto p-4 sm:p-6 lg:p-8">

        <!-- Cards de Estatísticas -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                <i class="fas fa-smile-beam text-green-400 text-6xl mb-4"></i>
                <h2 class="text-2xl font-bold text-white"><?php echo $sentimentos['positivo']; ?></h2>
                <p class="text-gray-400">Feedbacks Positivos</p>
            </div>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                <i class="fas fa-meh text-yellow-400 text-6xl mb-4"></i>
                <h2 class="text-2xl font-bold text-white"><?php echo $sentimentos['neutro']; ?></h2>
                <p class="text-gray-400">Feedbacks Neutros</p>
            </div>
            <div class="bg-gray-800 rounded-xl shadow-lg p-6 flex flex-col items-center justify-center">
                <i class="fas fa-angry text-red-400 text-6xl mb-4"></i>
                <h2 class="text-2xl font-bold text-white"><?php echo $sentimentos['negativo']; ?></h2>
                <p class="text-gray-400">Feedbacks Negativos</p>
            </div>
        </section>

        <!-- Seção de filtros -->
        <section class="bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
            <h3 class="text-lg font-bold mb-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtros</h3>
            <form id="filter-form" method="get">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Filtro Campanhas -->
                    <div class="relative dropdown">
                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                            <span>Campanhas</span>
                            <?php if(!empty($_GET['campanhas'])): ?><span class="filter-badge"><?php echo count($_GET['campanhas']); ?></span><?php endif; ?>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu w-64 p-4">
                            <?php if($campanhas) while($c = $campanhas->fetch_assoc()): ?>
                                <label class="flex items-center text-white mb-2 cursor-pointer">
                                    <input type="checkbox" name="campanhas[]" value="<?php echo $c['I_COD_CAMPANHA']; ?>" class="form-checkbox" onchange="this.form.submit()" <?php if(isset($_GET['campanhas']) && in_array($c['I_COD_CAMPANHA'], $_GET['campanhas'])) echo 'checked'; ?>>
                                    <span class="ml-2"><?php echo htmlspecialchars($c['S_NM_CAMPANHA']); ?></span>
                                </label>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Filtro Produtos -->
                    <div class="relative dropdown">
                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                            <span>Produtos</span>
                            <?php if(!empty($_GET['produtos'])): ?><span class="filter-badge"><?php echo count($_GET['produtos']); ?></span><?php endif; ?>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu w-64 p-4">
                            <?php if($produtos && $produtos->num_rows > 0): ?>
                                <?php while($p = $produtos->fetch_assoc()): ?>
                                    <label class="flex items-center text-white mb-2 cursor-pointer">
                                        <input type="checkbox" name="produtos[]" value="<?php echo $p['I_COD_PRODUTO']; ?>" class="form-checkbox" onchange="this.form.submit()" <?php if(isset($_GET['produtos']) && in_array($p['I_COD_PRODUTO'], $_GET['produtos'])) echo 'checked'; ?>>
                                        <span class="ml-2"><?php echo htmlspecialchars($p['S_NM_PRODUTO'] . ' (Tam: ' . $p['S_TAM_PRODUTO'] . ', Cor: ' . $p['S_COR_PRODUTO'] . ')'); ?></span>
                                    </label>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <span class="text-gray-400 text-sm px-2">Selecione uma campanha para ver os produtos.</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Filtro Sentimento -->
                    <div class="relative dropdown">
                        <button type="button" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                            <span>Sentimento</span>
                            <?php if(!empty($_GET['sentimentos'])): ?><span class="filter-badge"><?php echo count($_GET['sentimentos']); ?></span><?php endif; ?>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                        <div class="dropdown-menu w-64 p-4">
                            <label class="flex items-center text-white mb-2 cursor-pointer">
                                <input type="checkbox" name="sentimentos[]" value="1" class="form-checkbox" onchange="this.form.submit()" <?php if(isset($_GET['sentimentos']) && in_array(1, $_GET['sentimentos'])) echo 'checked'; ?>>
                                <span class="ml-2">Positivo</span>
                            </label>
                             <label class="flex items-center text-white mb-2 cursor-pointer">
                                <input type="checkbox" name="sentimentos[]" value="2" class="form-checkbox" onchange="this.form.submit()" <?php if(isset($_GET['sentimentos']) && in_array(2, $_GET['sentimentos'])) echo 'checked'; ?>>
                                <span class="ml-2">Neutro</span>
                            </label>
                             <label class="flex items-center text-white mb-2 cursor-pointer">
                                <input type="checkbox" name="sentimentos[]" value="0" class="form-checkbox" onchange="this.form.submit()" <?php if(isset($_GET['sentimentos']) && in_array(0, $_GET['sentimentos'])) echo 'checked'; ?>>
                                <span class="ml-2">Negativo</span>
                            </label>
                        </div>
                    </div>
                    
                    <a href="?" class="text-indigo-400 hover:text-indigo-300 ml-auto">Limpar Filtros</a>
                </div>
            </form>
        </section>

        <!-- Lista geral de feedbacks -->
        <section class="bg-gray-800 rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold mb-6"><i class="fas fa-list-ul mr-2"></i> Lista Geral de Feedbacks</h3>
            <div class="space-y-6">
                <?php if ($feedbacks && $feedbacks->num_rows > 0): ?>
                    <?php while($fb = $feedbacks->fetch_assoc()): ?>
                    <?php
                        $sentiment_icon = 'fa-meh text-yellow-400'; 
                        if ($fb['I_SENT_FEEDBACK'] == 1) $sentiment_icon = 'fa-smile-beam text-green-400'; 
                        if ($fb['I_SENT_FEEDBACK'] == 2) $sentiment_icon = 'fa-angry text-red-400';     
                    ?>
                    <div class="bg-gray-700 p-5 rounded-lg flex items-start space-x-4">
                        <i class="fas <?php echo $sentiment_icon; ?> text-3xl mt-1"></i>
                        <div class="flex-1">
                            <p class="text-gray-200"><?php echo nl2br(htmlspecialchars($fb['S_TXT_FEEDBACK'])); ?></p>
                            <div class="text-sm text-gray-400 mt-3 flex items-center flex-wrap gap-x-4 gap-y-1">
                                <span><i class="fas fa-user mr-1"></i> <?php echo htmlspecialchars($fb['S_AUTOR_FEEDBACK']); ?></span>
                                <span><i class="fas fa-calendar-alt mr-1"></i> <?php echo date("d/m/Y H:i", strtotime($fb['DT_FEEDBACK'])); ?></span>
                                <span><i class="fas fa-bullhorn mr-1"></i> Campanha: <?php echo htmlspecialchars($fb['S_NM_CAMPANHA']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center py-10">
                        <i class="fas fa-search text-5xl text-gray-500 mb-4"></i>
                        <p class="text-gray-400">Nenhum feedback encontrado com os filtros selecionados.</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

</body>
</html>

<?php
if ($link && !$link->connect_error) {
    $link->close();
}
?>
