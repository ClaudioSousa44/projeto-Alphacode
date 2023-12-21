<?php

/***********************************************************************
 * Objetivo: Manipular dados dentro do banco de dados
 * Autor: Claudio Sousa
 * Data: 15/12/2023
 * Versão: 1.0
 ************************************************************************/

require_once('./src/model/database/conexaoBanco.php');


function selectAllUsuarios()
{
    $conexao = conexaoBanco();

    $sql = "Select * from tbl_usuario";

    $result = mysqli_query($conexao, $sql);

    if ($result) {
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {
            $arrayDados[$cont] = array(
                "id" => $rsDados['id'],
                "nome" => $rsDados['nome'],
                "email" => $rsDados['email'],
                "data_nascimento" => $rsDados['data_nascimento'],
                "profissao" => $rsDados['profissao'],
                "telefone" => $rsDados['telefone'],
                "celular" => $rsDados['celular'],
                "whatsapp" => $rsDados['whatsapp'],
                "notificacoes_email" => $rsDados['notificacoes_email'],
                "notificacoes_sms" => $rsDados['notificacoes_sms'],
            );
            $cont++;
        }

        if (isset($arrayDados)) {
            return $arrayDados;
        } else {
            return false;
        }
    }
}

function selectUsuarioById($id)
{

    $conexao = conexaoBanco();

    $sql = "select * from tbl_usuario where id =" . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        while ($rsDados = mysqli_fetch_assoc($result)) {
            $arrayDados = array(
                "id" => $rsDados['id'],
                "nome" => $rsDados['nome'],
                "email" => $rsDados['email'],
                "data_nascimento" => $rsDados['data_nascimento'],
                "profissao" => $rsDados['profissao'],
                "telefone" => $rsDados['telefone'],
                "celular" => $rsDados['celular'],
                "whatsapp" => $rsDados['whatsapp'],
                "notificacoes_email" => $rsDados['notificacoes_email'],
                "notificacoes_sms" => $rsDados['notificacoes_sms'],
            );
        }

        if (isset($arrayDados))
            return $arrayDados;
        else
            return false;
    }
}

function insertUsuario($dadosUsuario)
{

    $statusResposta = (bool) false;

    $conexao = conexaoBanco();

    $sql = " 
    insert into tbl_usuario (
       nome,
       data_nascimento,
       email,
       profissao,
       telefone,
       celular,
       whatsapp,
       notificacoes_email,
       notificacoes_sms
       ) values (
       '".$dadosUsuario['nome']."',
       '".$dadosUsuario['data_nascimento']."',
       '".$dadosUsuario['email']."',
       '".$dadosUsuario['profissao']."',
       '".$dadosUsuario['telefone']."',
       '".$dadosUsuario['celular']."',
      ".$dadosUsuario['whatsapp']. ",
       ".$dadosUsuario['notificacoes_email'].",
      ".$dadosUsuario['notificacoes_sms']."
);";

    if (mysqli_query($conexao, $sql)) {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }
    
    return $statusResposta;
}



function deleteUsuario($id)
{
    $conexao = conexaoBanco();

    $statusResposta = (bool) false;

    $sql = "delete from tbl_usuario where id =" . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {
        if (mysqli_affected_rows($conexao)) {
            $statusResposta = true;
        }
    }

    return $statusResposta;
}

function updateUsuario( $dadosUsuario){
    $statusResposta = (bool) false;
    $conexao = conexaoBanco();

    $sql =
    "
    update tbl_usuario set
    nome = '".$dadosUsuario['nome']. "',
    data_nascimento = '" . $dadosUsuario['data_nascimento'] . "',
    email = '".$dadosUsuario['email']."',
    profissao = '".$dadosUsuario['profissao']."',
    telefone = '".$dadosUsuario['telefone']."',
    celular = '".$dadosUsuario['celular']."',
    whatsapp = '".$dadosUsuario['whatsapp']."',
    notificacoes_email =  '".$dadosUsuario['notificacoes_email']."',
    notificacoes_sms = '".$dadosUsuario['notificacoes_sms']."'
    where id = ". $dadosUsuario['id'];
    

    if (mysqli_query($conexao, $sql)) {
         $statusResposta = true;
    }

    return $statusResposta;
}
