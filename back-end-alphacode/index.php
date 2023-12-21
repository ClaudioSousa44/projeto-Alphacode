<?php
require_once('./vendor/autoload.php');
require_once('./src/controller/controllerUsuario.php');

$config = ['settings' => ['displayErrorDetails' => true]];
$app = new \Slim\App($config);



header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

header('Content-Type: application/json');


$app->get('/v1/usuarios', function ($request, $response, $args) {
    $dadosResposta = buscarUsuarios();
    $status = (int)json_encode($dadosResposta['status']);


    return $response    ->withStatus($status)
                        ->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($dadosResposta));
   
});

$app->get('/v1/usuarios/{id}', function ($request, $response, $args) {

    $id =  $args['id'];
    $dados = buscarUsuarioPorId($id);
    $status = (int) json_encode($dados['status']);

        return $response    ->withStatus($status)
                            ->withHeader('Content-Type', 'application/json')
                            ->write(json_encode($dados));
    
});

$app->post('/v1/usuarios', function ($request, $response, $args) {

    $contentTypeHeader = $request->getHeaderLine('Content-Type');
    $contentType =  explode(";", $contentTypeHeader);

    if ($contentType[0] == 'application/json') {

        $dadosBody = $request->getParsedBody();

        $arrayDados = array($dadosBody);

        $dadosResposta = inserirUsuario($arrayDados);

        $status = (int) json_encode($dadosResposta['status']);

        return $response    ->withStatus( $status)
                            ->withHeader('Content-Type', 'application/json')
                            ->write(json_encode($dadosResposta));

    } else {

        $dadosResposta = array(
            'status' => 415,
            'message' => 'O tipo de mídia Content-Type da solicitação não é compatível com o servdor. Tipo aceito: [application/json]'
        );

        return $response    ->withStatus(415)
                            ->withHeader('Content-Type', 'application/json')
                            ->write(json_encode($dadosResposta));
    }
});

$app->delete('/v1/usuarios/{id}', function ($request, $response, $args) {
    $id = $args['id'];

    $dadosResposta = deletarUsuario($id);
    $status = (int)json_encode($dadosResposta['status']);

    return $response    ->withStatus($status)
                        ->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($dadosResposta));
});

$app->put('/v1/usuarios/{id}', function ($request, $response, $args){

    $id = $args['id'];
    $contentTypeHeader = $request->getHeaderLine('Content-Type');
    $contentType =  explode(";", $contentTypeHeader);

    if ($contentType[0] == 'application/json') {

        $dadosBody = $request->getParsedBody();

        $arrayDados = array($dadosBody);

        $dadosResposta = atualizarUsuario($id,$arrayDados);

        $status = (int) json_encode($dadosResposta['status']);



        return $response->withStatus($status)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($dadosResposta));
        
    } else {

        $dadosResposta = array(
            'status' => 415,
            'message' => 'O tipo de mídia Content-Type da solicitação não é compatível com o servdor. Tipo aceito: [application/json]'
        );

        return $response->withStatus(415)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($dadosResposta));
    }
});



$app->run();
