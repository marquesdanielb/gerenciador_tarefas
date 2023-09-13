<?php

function traduz_prioridade($prioridade)
{
    switch ($prioridade) {
        case '2':
            return 'Média';
            break;
        case '3':
            return 'Alta';
            break;
        
        default:
            return 'Baixa';
            break;
    }
}

function traduz_concluida($concluida)
{
    if ($concluida == 0) {
        return 'Não';
    }

    return 'Sim';
}

function traduz_prazo_para_banco($prazo)
{
    if ($prazo == '') {
        return '';
    }

    $partes = explode('/', $prazo);

    if (count($partes) != 3) {
        return $prazo;
    }

    $objeto_data = DateTime::createFromFormat('d/m/Y', $prazo);

    return $objeto_data->format('Y-m-d');    
}

function traduz_prazo_para_exibir($prazo_banco)
{
    if ($prazo_banco == '' || $prazo_banco == '0000-00-00') {
        return '';
    }
    
    return $prazo_banco->format('d/m/Y');
}

function tem_post()
{
    return count($_POST) > 0;
}

function validar_data($data)
{
    $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
    $resultado = preg_match($padrao, $data);

    if ($resultado == 0) {
        return false;
    }

    $dados = explode('/', $data);

    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];

    return checkdate($mes, $dia, $ano);
}

function tratar_anexo($anexo)
{
    $padrao = '/^.+(\.pdf|\.zip)$/';
    $resultado = preg_match($padrao, $anexo['name']);

    if ($resultado == 0) {
        return false;
    }

    move_uploaded_file($anexo['tmp_name'], 
                        "/../anexos/{$anexo['name']}");

    return true;
}

function traduz_data_br_para_objeto($data)
{
    if ($data == "") {
        return "";
    }
    
    $dados = explode("/", $data);

    if (count($dados) != 3) {
        return $data;
    }

    return DateTime::createFromFormat('d/m/Y', $data);
}
