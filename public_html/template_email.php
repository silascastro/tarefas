<h1>Tarefa: <?php echo $tarefa['nome']; ?></h1>

<p>
    <strong>Concluída:</strong>
    <?php echo traduz_concluida($tarefa['concluida']); ?>
</p>

<p>
    <strong>Descricao:</strong>
    <?php echo nl2br($tarefa['descricao']);?>
</p>

<p>
    <strong>Prazo:</strong>
    <?php   echo traduz_data_para_exibir($tarefa['prazo']); ?>
</p>

<p>
    <strong>Prioridade:</strong>
    <?php echo traduz_prioridade($tarefa['prioridade']); ?>
</p>

<?php if(count($anexos) > 0) : ?>
    <p> Esta tarefa contém anexos!</p>
<?php endif; ?>

