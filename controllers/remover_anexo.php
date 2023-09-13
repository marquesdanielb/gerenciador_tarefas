<?php

try {
    $anexo = $repositorio_tarefas->buscar_anexo($_GET['id']);
} catch (Exception $e) {
    echo "Erro ao buscar o anexo: " . $e->getMessage();
    die();
}

$repositorio_tarefas->remover_anexo($anexo->getId());
unlink(__DIR__ . '/../anexos/' . $anexo->getArquivo());

header('Location: index.php?rota=tarefa&id=' . $anexo->getTarefa_id());

require __DIR__ . "/../views/template_tarefa.php";