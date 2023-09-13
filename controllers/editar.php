<?php

try {
    $tarefa = $repositorio_tarefas->buscar($_GET['id']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erro ao buscar a tarefa: " . $e->getMessage();
    die();
}

$exibir_tabela = false;
$tem_erros = false;
$erros_validacao = [];

if (tem_post()) {
    if (array_key_exists('nome', $_POST) && strlen($_POST['nome']) > 0) {
            $tarefa->setNome($_POST['nome']);
    } else {
            $tem_erros = true;
            $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
    }

    if (array_key_exists('descricao', $_POST)) {
        $tarefa->setDescricao($_POST['descricao']);
    }

    if (array_key_exists('prazo', $_POST) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa->setPrazo(traduz_data_br_para_objeto($_POST['prazo']));
        } else {
        $tem_erros = true;
        $erros_validacao['prazo'] = 'O prazo não é uma data válida';
        }
    }

    if (array_key_exists('concluida', $_POST)) {
        $tarefa->setConcluida(true);
    }

    $tarefa->setPrioridade($_POST['prioridade']);

if (array_key_exists('concluida', $_POST)) {
    $tarefa->setConcluida(true);
}

    if (!$tem_erros) {
        $repositorio_tarefas->atualizar($tarefa);
        header('Location: index.php?rota=tarefas');
        die();
    }
}

require __DIR__ . "/../views/template.php";        
