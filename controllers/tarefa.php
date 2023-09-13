<?php

try {
    $tarefa = $repositorio_tarefas->buscar($_GET['id']);
} catch (Exception $e) {
    http_response_code(404);
    echo "Erro ao buscar a tarefa: " . $e->getMessage();
    die();
}

$tarefa = $repositorio_tarefas->buscar($_GET['id']);

$tem_erros = false;
$erros_validacao = [];

if (tem_post()) {
    $tarefa_id = $_POST['tarefa_id'];

    if (!array_key_exists('anexo', $_FILES)) {
        $tem_erros = true;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        $dados_anexo = $_FILES['anexo'];

        if (tratar_anexo($_FILES['anexo'])) {
            $anexo = new Tarefas\Models\Anexo();
            $anexo->setTarefa_id($tarefa_id);
            $anexo->setNome($dados_anexo['name']);
            $anexo->setArquivo($dados_anexo['name']);
        } else {
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Envie anexos nos formatos zip ou pdf';
        }
    }

    if (!$tem_erros) {
        $repositorio_tarefas->salvar_anexo($anexo);
    }
}

$anexos = $repositorio_tarefas->buscar_anexos($_GET['id']);

require __DIR__ . "/../views/template_tarefa.php";