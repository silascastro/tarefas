
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'bibliotecas/vendor/autoload.php';

    function traduz_prioridade($codigo){
        $prioridade = '';

        switch($codigo){
            case 1:
                $prioridade = 'Baixa';
                break;
            case 2:
                $prioridade = 'Média';
                break;
            case 3:
                $prioridade = 'Alta';
                break;
        }
        return $prioridade;
    }


    function traduz_data_para_banco($data){
        if($data == ''){
            return '';
        }

        $dados = explode("/", $data);

        if(count($dados) != 3){
            return $data;
        }

        $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

        return $data_mysql;
    }

    function validar_data($data){
        $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        $resultado = preg_match($padrao, $data);

        if(!$resultado){
            return false;
        }

        $dados = explode('/',$data);

        $dia = $dados[0];
        $mes = $dados[1];
        $ano = $dados[2];

        $resultado = checkdate($mes,$dia, $ano);

        return $resultado;
    }



    function traduz_data_para_exibir($data){

        if($data == "" OR $data == "0000-00-00"){
            return "";
        }

        $dados = explode("-",$data);

        if(count($dados) != 3){
            return $data;
        }

        $exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";


        return $exibir;
    }

    function traduz_concluida($concluida){
        if($concluida == 1){
            return "sim";
        }else{
            return "não";
        }
    }

    function tem_post(){
        if(count($_POST) > 0){
            return true;

        }else{
            return false;
        }
    }


    function tratar_anexo($anexo){
        $padrao = '/^.+(\.pdf|\.zip)$/';
        $resultado = preg_match($padrao, $anexo['name']);

        if(! $resultado){
            return false;
        }

        move_uploaded_file($anexo['tmp_name'],"anexos/{$anexo['name']}");

        return true;
    }


    function enviar_email($tarefa, $anexos = array()){
        $email = new PHPMailer();

        $corpo = preparar_corpo_email($tarefa,$anexos);

        try{
            //$email->SMTPDebug = 2;
            $email->isSMTP();
            $email->SMTPAuth = true;
            $email->Host = 'smtp.gmail.com';
            $email->Username = 'silascastro15@gmail.com';
            $email->Password = '09/head,18*1';
            $email->Port = 587;

            $email->SMTPSecure = 'tls';

            $email->setFrom('silascastro15@gmail.com','silas');
            $email->addAddress(EMAIL_NOTIFICACAO,'silas');
            $email->Subject = "Aviso de tarefa: {$tarefa['nome']}";
            $email->isHTML(true);
            $email->msgHTML($corpo);

            foreach ($anexos as $anexo) {
                $email->addAttachment("anexos/{$anexo['arquivo']}");
            }

            $email->send();
        }catch (\Exception $e){
            //die();
        }

    }

    function preparar_corpo_email($tarefa, $anexos){

        //Falar para o php que não é para enviar
        //navegador
        ob_start();

        //incluir o arquivo template_email.php
        include "template_email.php";

        //guardar o conteúdo do arquivo em uma variável;
        $corpo = ob_get_contents();

        ob_end_clean();

        return $corpo;
    }





?>
