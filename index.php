<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="css/style.css">
    <script>
    function limparParametrosURL() {
        if (window.location.search) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }
</script>
</head>
<body>
    <nav style="width: 100%; justify-content: center; background: #f0f0f0; padding: 10px 0; box-sizing: border-box; display: flex; gap: 20px;">
        <a href="?page=cadastrar" style="text-decoration: none; color: #333; font-weight: bold;">Cadastrar nova Atividade</a>
        <a href="?page=listar" style="text-decoration: none; color: #333; font-weight: bold;">Listar Atividade</a>
    </nav>
    <div id="container" style="height: calc(98vh - 50px); overflow-y: auto; padding: 20px; box-sizing: border-box;">
        <?php
            if (isset($_GET['page']) && $_GET['page'] === 'cadastrar') {
                require_once __DIR__ . '/pages/atividade_cadastrar.php';
            } 
            elseif (isset($_GET['page']) && $_GET['page'] === 'editar') {
                require_once __DIR__ . '/pages/atividade_editar.php';
            }
            elseif (isset($_GET['page']) && $_GET['page'] === 'deletar') {
                require_once __DIR__ . '/pages/atividade_deletar.php';
            }
            else {
                require_once __DIR__ . '/pages/atividade_listar.php';
                if(isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
                    echo '<script> alert("Atividade deletada com sucesso."); limparParametrosURL();</script>';
                }
            }
        ?>
    </div>


   
</body>
</html>

