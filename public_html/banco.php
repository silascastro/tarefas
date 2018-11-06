<?php
    include "config.php";



    $conexao = mysqli_connect(DB_SERVIDOR,DB_USUARIO,DB_SENHA,DB_BANCO);

    if(!($conexao)){
        echo 'erro ao conectar ao banco!';
        die();
    }


    function buscar_tarefas($conexao){

        $sqlBusca = 'SELECT * FROM dados';
        $resultado = mysqli_query($conexao, $sqlBusca);

        $tarefas = array();


        while($tarefa = mysqli_fetch_assoc($resultado)){
            $tarefas[] = $tarefa;
        }

        return $tarefas;
    }


    function gravar_tarefa($conexao, $tarefa){
        $sqlGravar = " INSERT INTO dados (nome, descricao, prioridade, prazo, concluida)
        VALUES
        (
            '{$tarefa['nome']}',
            '{$tarefa['descricao']}',
            {$tarefa['prioridade']},
            '{$tarefa['prazo']}',
            {$tarefa['concluida']}

        )
        ";

        mysqli_query($conexao,$sqlGravar);
    }



    //editar

    function buscar_tarefa($conexao, $id){
        $sqlBusca = 'SELECT * FROM dados WHERE id = ' .$id;

        $resultado = mysqli_query($conexao, $sqlBusca);
        return mysqli_fetch_assoc($resultado);
    }


    function editar_tarefa($conexao, $tarefa){
        $sql = "
            UPDATE dados SET
                nome = '{$tarefa['nome']}',
                descricao = '{$tarefa['descricao']}',
                prioridade = {$tarefa['prioridade']},
                prazo = '{$tarefa['prazo']}',
                concluida = {$tarefa['concluida']}
            WHERE id = {$tarefa['id']}
        ";

        mysqli_query($conexao, $sql);
    }



    //remover

    function remover_tarefa($conexao, $id){
        $sqlRemover = 'DELETE FROM dados WHERE id = '.$id;

        mysqli_query($conexao, $sqlRemover);
    }


    function gravar_anexo($conexao, $anexo){
      $sqlGravar = "INSERT INTO anexos
       (tarefa_id, nome, arquivo)
        VALUES
        (
          {$anexo['tarefa_id']},
          '{$anexo['nome']}',
          '{$anexo['arquivo']}'

        )
      ";

      mysqli_query($conexao,$sqlGravar);
    }

    function buscar_anexos($conexao, $tarefa_id){
      $sql = "SELECT * FROM anexos WHERE tarefa_id = {$tarefa_id}";
      $resultado = mysqli_query($conexao,$sql);

      $anexos = array();

      while($anexo = mysqli_fetch_assoc($resultado)){
        $anexos[] = $anexo;
      }

      return $anexos;
    }

?>
