<?php

namespace Administrador\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Mvc\View\Http\ViewManager;
use Zend\View\Renderer\PhpRenderer;

class IndexMiddleware
{

    public function __construct(PhpRenderer $renderer, ViewManager $view)
    {
        $this->renderer = $renderer;
        $this->view = $view;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (empty($request->getHeader('Authorization'))) {
            $var = ['message' => 'Acesso não autorizado'];

            return new HtmlResponse(json_encode($var), 401, ['Content-Type' => 'application/json;charset=utf-8']);
        }
    }

}
