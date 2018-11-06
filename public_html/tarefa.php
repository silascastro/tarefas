<?php

    include "config.php";
    include "banco.php";
    include "funcoes.php";


    $tem_erros = false;
    $erros_validacao = array();

    if(tem_post()){
        //upload dos anexos
        $tarefa_id = $_POST['tarefa_id'];

        if(!isset($_FILES['anexo'])){
            $tem_erros = true;
            $erros_validacao['anexo'] = 'Você deve selecionar um arquivo!';
        }else{
            if(tratar_anexo($_FILES['anexo'])){
                $anexo = array();
                $anexo['tarefa_id'] = $tarefa_id;
                $anexo['nome'] = $_FILES['anexo']['name'];
                $anexo['arquivo'] = $_FILES['anexo']['name'];
            }else{
                $tem_erros = true;
                $erros_validacao['anexo'] = 'envie apenas anexos nos formatos zip';
            }
        }

        if(!$tem_erros){
            gravar_anexo($conexao, $anexo);
        }


    }

    $tarefa = buscar_tarefa($conexao, $_GET['id']);
    $anexos = buscar_anexos($conexao, $_GET['id']);
    include "template_tarefa.php";

?>
