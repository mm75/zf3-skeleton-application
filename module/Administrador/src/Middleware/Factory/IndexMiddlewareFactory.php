<?php

namespace Administrador\Middleware\Factory;

use \Administrador\Middleware\IndexMiddleware;
use \Interop\Container\ContainerInterface;

class IndexMiddlewareFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $viewRenderer = $container->get('ViewRenderer');
        $viewManager = $container->get('ViewManager');
        return new IndexMiddleware($viewRenderer, $viewManager);
    }

}
