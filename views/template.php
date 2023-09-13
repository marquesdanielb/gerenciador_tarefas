<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/estilo.css">
        <title>Gerenciador de Tarefas</title>
    </head>
    <body>
        <h1><a href="tarefas.php">Gerenciador de Tarefas</a></h1>
    
        <?php require 'formulario.php'; ?>
    
        <?php if ($exibir_tabela) : ?>
            <?php require 'tabela.php'; ?>
        <?php endif; ?>
    </body>
</html>