<?php

try {
    $tarefa = $repositorio_tarefas->buscar($_GET['id']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erro ao buscar a tarefa: ".$e->getMessage();
}

$exibir_tabela = false;
$tem_erros = false;
$erros_validacao = array();

if (tem_post()) {

    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
        $tarefa->setNome($_POST['nome']);
    } else {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
    }

    if (isset($_POST['descricao'])) {
        $tarefa->setDescricao($_POST['descricao']);
    } else {
        $tarefa->setDescricao('');
    }

    $tarefa->setPrioridade($_POST['prioridade']);

    if (isset($_POST['concluida'])) {
        $tarefa->setConcluida(true);
    } else {
        $tarefa->setConcluida(false);
    }

    if (! $tem_erros) {
        $repositorio_tarefas->atualizar($tarefa);
        header('Location: index.php?rota=tarefas');
        die();
    }
}

require __DIR__."/../views/template.php";
