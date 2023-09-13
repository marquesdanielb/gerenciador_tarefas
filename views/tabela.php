<table>
    <tr>
        <th>Tarefa</th>
        <th>Descrição</th>
        <th>Prazo</th>
        <th>Prioridade</th>
        <th>Concluída</th>
        <th>Opções</th>
    </tr>
    <?php foreach ($lista_tarefas as $tarefa) : ?>
        <tr>
            <td>
                <a href="index.php?rota=tarefa&id=<?php echo $tarefa->getId(); ?>">
                    <?php echo $tarefa->getNome(); ?>
                </a>
            </td>
            <td><?php echo $tarefa->getDescricao(); ?></td>
            <td><?php echo traduz_prazo_para_exibir($tarefa->getPrazo()); ?></td>
            <td><?php echo traduz_prioridade($tarefa->getPrioridade()); ?></td>
            <td><?php echo traduz_concluida($tarefa->getConcluida()); ?></td>
            <td>
                <a href="index.php?rota=editar&id=<?php echo $tarefa->getId(); ?>">Editar</a>
                <a href="index.php?rota=remover&id=<?php echo $tarefa->getId(); ?>">Remover</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>