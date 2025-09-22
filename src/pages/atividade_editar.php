<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/atividade.php';
     require_once __DIR__ . '/../data/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $atividade = new Atividades($conn);
        $atividade->id = $id;
        $atividade->titulo = $titulo;
        $atividade->descricao = $descricao;
        $atividade->inicio = $inicio;
        $atividade->fim = $fim;
        $atividade->status = $status;
        $atividade = $atividade->editar();
    }

    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID da atividade inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de atividades</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $atividade = new Atividades($conn);
    $atividade_atual = $atividade->consultarPorId( $id);

    if(!$atividade_atual) {
        echo '<p style="color: red; text-align: center;">Tarefa não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de tarefas</a></p>';
        exit;
    }
    
?>
    
    <div class="form-container">
        <h1>Cadastrar Nova Atividade</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($atividade_atual['id']); ?>">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($atividade_atual['titulo']) ?>" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($atividade_atual['descricao'])?></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" value="<?php echo htmlspecialchars($atividade_atual['inicio']) ?>" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" value="<?php echo htmlspecialchars($atividade_atual['fim']) ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Suave" <?php echo ($atividade_atual['status']==='Suave') ? 'selected' : ''; ?>>Suave</option>
                    <option value="Urgente"  <?php echo ($atividade_atual['status']==='Urgente') ? 'selected' : ''; ?>>Urgente</option>
                    <option value="Concluida"  <?php echo ($atividade_atual['status']==='Concluida') ? 'selected' : ''; ?>>Concluida</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Editar Atividade</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Atividade alterada com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao alterar atividade. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
