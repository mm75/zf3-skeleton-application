<?php

namespace Administrador\Controller;

use \DateTime;
use \Firebase\JWT\JWT;
use \Zend\View\Model\JsonModel;

/**
 * Classe responsável pelo controller "Usuariosys".
 * Disponibiliza as opções de CRUD via API REST.
 * 
 * No construtor do mesmo é injetado o serviço para manipulação dos dados e
 * a dependência para serializar dados em JSON/XML.
 *
 * PHP Version 5.6.0
 *
 * @category Controller
 * @package  Administrador
 * @author Jackson Veroneze <jackson@inovadora.com.br>
 * @license  http://inovadora.com.br/licenca  Inovadora
 * @link     #
 * @version 0.0.1
 */
class RequestTokenController extends AbstractController
{

    public function create($data)
    {
        if ($data['user'] === 'admin' && $data['password'] === '123') {
            $payload = [
                "iat" => (new DateTime())->getTimeStamp(),
                "exp" => (new DateTime("now +2 hours"))->getTimeStamp(),
                "jti" => 'LAKSJLASJDALSDJ',
                "identity" => [
                    'user' => $data['user']
                ]
            ];

            $token = JWT::encode($payload, JWT_TOKEN, "HS256");

            $this->response->setStatusCode(200);
            return new JsonModel(['token' => $token]);
        }

        $this->response->setStatusCode(401);
        return new JsonModel(['token' => '']);
    }

}
