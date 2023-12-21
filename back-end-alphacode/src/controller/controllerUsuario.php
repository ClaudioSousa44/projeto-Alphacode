<?php

/***********************************************************************
 * Objetivo: Arquivo de controle dos dados da tabela produto em nosso sistema
 * Autor: Claudio Sousa
 * Data: 15/12/2023
 * Versão: 1.0
 ************************************************************************/

require_once('./src/model/DAO/usuarioDAO.php');
function buscarUsuarios()
{

    $dados = selectAllUsuarios();

    if (!empty($dados)) {
         
        return array(
            'status' => 200,
            'message' => 'Requisição bem sucedida.',
            'quantidade' => count($dados),
            'dados' => $dados
        );

    } else
        return array(
        'status' => 404,
        'message' => 'Nenhum dado encontrado',
        );
}

function buscarUsuarioPorId($id)
{
    

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        $dados = selectUsuarioById($id);

        if (!empty($dados)) {
           
            return array(
                'status' => 200,
                'message' => 'Requisição bem sucedida.',
                'dados' => $dados
            ); 

        } else {
            return array(
                'status'   => 404,
                'message'  => 'Nenhum usuario encontrado'
            );
        }
    } else {

        $dadosArray =  array(
            'status'   => 400,
            'message'  => 'Não é possível buscar um registro sem informar um id válido.'
        );
        $dadosUsuarioJSON = json_encode($dadosArray);

        return $dadosUsuarioJSON;
    }
}

function deletarUsuario($id){
    

    if ($id != 0 && !empty($id) && is_numeric($id)) {
        if(selectUsuarioById($id)){
            if (deleteUsuario($id)) {
                return array(
                    'status' => 200,
                    'message' => "Usuário excluido com sucesso"
                );
            } else {
                return array(
                    'status'   => 500,
                    'message'  => 'O banco de dados não pode excluir o registro.'
                );
            }

        }else{
            return array(
                'status'   => 404,
                'message'  => 'O ID informado não é válido'
            );
        }
        
        
    }else{
        return array(
            'status' => 400,
            'message' => 'O ID informado na requisição não é válido ou não foi encaminhado.'
        );
    }
}

function inserirUsuario($dadosUsuario){

    if(
        !empty($dadosUsuario[0]['nome'])  &&  !is_int($dadosUsuario[0]['nome'])  && strlen($dadosUsuario[0]['nome']) <= 150 &&
        !empty($dadosUsuario[0]['data_nascimento']) && !is_int($dadosUsuario[0]['data_nascimento']) && strlen($dadosUsuario[0]['data_nascimento']) <= 10 &&
        !empty($dadosUsuario[0]['email']) && !is_int($dadosUsuario[0]['email']) && strlen($dadosUsuario[0]['email']) <= 255 &&
        !empty($dadosUsuario[0]['profissao']) && !is_int($dadosUsuario[0]['profissao']) && strlen($dadosUsuario[0]['profissao']) <= 50 &&
        !empty($dadosUsuario[0]['telefone']) && !is_int($dadosUsuario[0]['telefone']) && strlen($dadosUsuario[0]['telefone']) <= 20 &&
        !empty($dadosUsuario[0]['celular']) &&  !is_int($dadosUsuario[0]['celular']) && strlen($dadosUsuario[0]['celular']) <= 20   ){

        $arrayDados = array(
            "nome"              => $dadosUsuario[0]['nome'],
            "telefone"          => $dadosUsuario[0]['telefone'],
            "celular"           => $dadosUsuario[0]['celular'],
            "email"             => $dadosUsuario[0]['email'],
            "data_nascimento"   => $dadosUsuario[0]['data_nascimento'],
            "profissao"         => $dadosUsuario[0]['profissao'],
            "whatsapp"          => $dadosUsuario[0]['whatsapp'],                  
            "notificacoes_email"=> $dadosUsuario[0]['notificacoes_email'],
            "notificacoes_sms"  => $dadosUsuario[0]['notificacoes_sms'],
        );

        if(insertUsuario($arrayDados)){
            return array(
                'status'   => 200,
                'message'  => 'Usuário inserido com sucesso',
                'dados'    => $arrayDados
            );
             

        }else{
          
            return array(
                'status'   => 500,
                'message'  => 'Não foi possivel inserir os dados no Banco de Dados',
            );
        }

    } else{

        return array(
            'status'   => 400,
            'message'  => 'Campos obrigatórios não foram preenchidos ou foram preenchidos de forma errada',
        );
    }
}

function atualizarUsuario($id, $dadosUsuario){
    if ($id != 0 && !empty($id) && is_numeric($id)) {

        if(selectUsuarioById($id)){
            if (
                !empty($dadosUsuario[0]['nome'])  &&  !is_int($dadosUsuario[0]['nome'])  && strlen($dadosUsuario[0]['nome']) <= 150 &&
                !empty($dadosUsuario[0]['data_nascimento']) && !is_int($dadosUsuario[0]['data_nascimento']) && strlen($dadosUsuario[0]['data_nascimento']) <= 10 &&
                !empty($dadosUsuario[0]['email']) && !is_int($dadosUsuario[0]['email']) && strlen($dadosUsuario[0]['email']) <= 255 &&
                !empty($dadosUsuario[0]['profissao']) && !is_int($dadosUsuario[0]['profissao']) && strlen($dadosUsuario[0]['profissao']) <= 50 &&
                !empty($dadosUsuario[0]['telefone']) && !is_int($dadosUsuario[0]['telefone']) && strlen($dadosUsuario[0]['telefone']) <= 20 &&
                !empty($dadosUsuario[0]['celular']) &&  !is_int($dadosUsuario[0]['celular']) && strlen($dadosUsuario[0]['celular']) <= 20
            ) {

                $arrayDados = array(
                    "id"                => $id,
                    "nome"              => $dadosUsuario[0]['nome'],
                    "telefone"          => $dadosUsuario[0]['telefone'],
                    "celular"           => $dadosUsuario[0]['celular'],
                    "email"             => $dadosUsuario[0]['email'],
                    "data_nascimento"   => $dadosUsuario[0]['data_nascimento'],
                    "profissao"         => $dadosUsuario[0]['profissao'],
                    "whatsapp"          => $dadosUsuario[0]['whatsapp'],
                    "notificacoes_email" => $dadosUsuario[0]['notificacoes_email'],
                    "notificacoes_sms"  => $dadosUsuario[0]['notificacoes_sms'],
                );

                if (updateUsuario( $arrayDados)) {
                    return array(
                        'status'   => 200,
                        'message'  => 'Usuário atualizado com sucesso',
                        'dados'    => $arrayDados
                    );
                } else {
                    return array(
                        'status'   => 500,
                        'message'  => 'Não foi possivel inserir os dados no Banco de Dados',
                    );
                }
        }else{
                return array(
                    'status'   => 400,
                    'message'  => 'Campos obrigatórios não foram preenchidos ou foram preenchidos de forma errada',
                );
        }

        } else {

            return array(
                'status'   => 404,
                'message'  => 'Nenhum usuario encontrado'
            );
            
        }


        
    } else {
        return array(
            'status' => 400,
            'message' => 'O ID informado na requisição não é válido ou não foi encaminhado.'
        );
    }
}




