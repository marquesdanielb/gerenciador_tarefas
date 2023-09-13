<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/estilo.css">
    <title>Anexos</title>
</head>
    <body>
        <div id="bloco_principal">
            <h1>Tarefa: <?php echo htmlentities($tarefa->getNome()); ?></h1>
            <p>
                <a href="index.php?rota=tarefas">
                    Voltar para a lista de tarefas
                </a>
            </p>
            <p>
                <strong>Concluída:</strong>
                <?php echo traduz_concluida($tarefa->getConcluida()); ?>
            </p>
            <p>
                <strong>Descrição:</strong>
                <?php echo nl2br(htmlentities($tarefa->getDescricao())); ?>
            </p>
            <p>
                <strong>Prazo:</strong>
                <?php echo traduz_prazo_para_exibir($tarefa->getPrazo()); ?>
            </p>
            <p>
                <strong>Prioridade:</strong>
                <?php echo traduz_prioridade($tarefa->getPrioridade()); ?>
            </p>

            <h2>Anexos</h2>
            <?php if (count($tarefa->getAnexos()) > 0) : ?>
                <table>
                    <tr>
                        <th>Arquivo</th>
                        <th>Opções</th>
                    </tr>
                    <?php foreach ($tarefa->getAnexos() as $anexo) : ?>
                        <tr>
                            <td>
                                <?php echo htmlentities($anexo->getNome()); ?>
                            </td>
                            <td>
                                <a href="anexos/<?php echo htmlentities($anexo->getArquivo()); ?>">Download</a>
                                <a href="index.php?rota=remover_anexo&id=<?php echo $anexo->getId(); ?>">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <p>Não há anexos para esta tarefa.</p>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa->getId(); ?>">
                <fieldset>
                    <legend>Novo anexo</legend>
                    <label>
                        <?php if ($tem_erros && array_key_exists('anexo', $erros_validacao)) : ?>
                            <span class="erro">
                                <?php echo $erros_validacao['anexo']; ?>
                            </span>
                        <?php endif; ?>
                        <input type="file" name="anexo">
                    </label>
                    <input type="submit" value="Cadastrar">
                </fieldset>
            </form>
        </div>
    </body>
</html>