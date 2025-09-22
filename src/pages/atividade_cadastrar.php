<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/atividade.php';
    require_once __DIR__ . '/../data/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $inicio = $_POST['inicio'] ?? '';
        $fim = $_POST['fim'] ?? '';
        $status = $_POST['status'] ?? '';

        $atividade = new Atividades($conn);
        $atividade->titulo = $titulo;
        $atividade->descricao = $descricao;
        $atividade->inicio = $inicio;
        $atividade->fim = $fim;
        $atividade->status = $status;
        $resultado = $atividade->cadastrar();
    }
?>
    <div class="form-container">
        <h1>Cadastrar Nova Atividade</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" required>
            </div>
            <div class="form-group">
                <label for="fim">Data de Fim:</label>
                <input type="date" id="fim" name="fim" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Suave">Suave</option>
                    <option value="Urgente">Urgente</option>
                    <option value="Concluida">Concluída</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar Atividade</button>
            </div>
            <?php
            if (isset($resultado)) {
                if ($resultado) {
                    echo '<p style="color: green; text-align: center;">Atividade cadastrada com sucesso!</p>';
                } else {
                    echo '<p style="color: red; text-align: center;">Erro ao cadastrar atividade. Tente novamente.</p>';
                }
            }  
            ?>
        </form>
    </div>
