<form method="POST">
    <input type="hidden" name="id" value="<?php echo $tarefa->getId(); ?>">
    <fieldset>
        <legend>Nova tarefa</legend>
        <label>
            Tarefa:
            <?php if ($tem_erros && array_key_exists('nome', $erros_validacao)) : ?>
                <span class="erro">
                    <?php echo $erros_validacao['nome']; ?>
                </span>
            <?php endif; ?>
            <input type="text" name="nome" value="<?php echo htmlentities($tarefa->getNome()); ?>">
        </label>
        <label>
            Descrição (Opcional):
            <textarea name="descricao"><?php echo htmlentities($tarefa->getDescricao()); ?></textarea>
        </label>
        <label>
            Prazo (Opcional):
            <?php if($tem_erros && array_key_exists('prazo', $erros_validacao)) : ?>
                <span class="erro">
                    <?php echo $erros_validacao['prazo']; ?>
                </span>
            <?php endif; ?>
            <input type="text" name="prazo" value="<?php echo traduz_prazo_para_exibir($tarefa->getPrazo()); ?>">
        </label>
        <fieldset>
            <legend>Prioridade:</legend>
            <label>
            <input type="radio" name="prioridade" value="1"
                <?php 
                    echo ($tarefa->getPrioridade() == 1) ? 'checked' : '';
                ?> /> Baixa
                <input type="radio" name="prioridade" value="2" 
                <?php 
                    echo ($tarefa->getPrioridade() == 2) ? 'checked' : '';
                ?>/> Média
                <input type="radio" name="prioridade" value="3" 
                <?php
                    echo ($tarefa->getPrioridade() == 3) ? 'checked' : '';
                ?>/> Alta
            </label>
        </fieldset>
        <label>
            Tarefa Concluída:
            <input type="checkbox" name="concluida" value="<?php echo $tarefa->getConcluida(); ?>" 
            <?php 
                echo ($tarefa->getConcluida() == 1) ? 'checked' : '';
            ?>/>
        </label>
        <input type="submit" value="<?php echo ($tarefa->getId() > 0) ? 'Atualizar' : 'Cadastrar'; ?>" class="botao">
    </fieldset>
</form>