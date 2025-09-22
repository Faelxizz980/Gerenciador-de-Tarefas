<?php
    require_once __DIR__ . '/../data/connection.php';
    require_once __DIR__ . '/../model/atividade.php';

    
    if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo '<p style="color: red; text-align: center;">ID da atividade inválido.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de atividades</a></p>';
        exit;
    } 


    $id = $_GET['id'];

    $atividade = new Atividades($conn);
    $atividade_atual = $atividade->consultarPorId( $id);

    if (!$atividade_atual) {
        echo '<p style="color: red; text-align: center;">Atividade não encontrada.</p>';
        echo '<p style="text-align: center;"><a href="/">Voltar para a lista de atividade</a></p>';
        exit;
    }

    $resultado = $atividade->deletar($id);

    if ($resultado) {               
        header('Location: /?deleted=true');
    } else {
        echo '<p style="color: red; text-align: center;">Erro ao deletar atividade . Tente novamente.</p>';
         echo '<p style="text-align: center;"><a href="/">Voltar para a lista de atividades</a></p>';
    }