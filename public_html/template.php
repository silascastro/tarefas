<!DOCTYPE html>
<html>
<head>
    <meta lang="pt-BR">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/template.css">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>

    <?php

            include "formulario.php";
    ?>
    <?php if($exibir_tabela) :?>
        <?php include "tabela.php"; ?>
<?php endif; ?>

<script src="index.js" charset="utf-8"></script>

</body>
</html>
