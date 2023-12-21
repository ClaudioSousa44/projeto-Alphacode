<?php

/**********************************************************************************
 * Objetivo: Criar conexão com o banco de dados
 * Autor: Claudio Sousa
 * Data: 15/12/2023
 * Versão: 1.0
 ***********************************************************************************/

const DBSERVER = 'localhost';
const DBUSER = 'root';
const DBPASSWORD = 'bcd127';
const DBNAME = 'db_alphacode';

function conexaoBanco(){

    $mysqli = new mysqli(DBSERVER, DBUSER, DBPASSWORD, DBNAME);
    if ($mysqli->connect_errno) {
        echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } 

    return $mysqli;
}



