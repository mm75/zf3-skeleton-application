<?php

namespace Administrador\Middleware;

use \Exception;
use \Firebase\JWT\JWT;
use \Psr\Http\Message\ResponseInterface;
use \Psr\Http\Message\ServerRequestInterface;
use \Zend\Diactoros\Response\HtmlResponse;

class IndexMiddleware
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $authorizationRaw = $request->getHeaderLine('Authorization');
        $authorizationFilter = filter_var($authorizationRaw, FILTER_SANITIZE_STRING);

        try {
            JWT::decode($authorizationFilter, JWT_TOKEN, ['HS256']);
        } catch (Exception $exc) {
            return new HtmlResponse(\json_encode([$exc->getMessage()]), 401, ['Content-Type' => 'application/json;charset=utf-8']);
        }
    }

}
