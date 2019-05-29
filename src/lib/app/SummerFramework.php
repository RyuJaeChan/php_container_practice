<?php

namespace wor\lib\app;

use wor\lib\exception\ServerException;
use wor\lib\mvc\ControllerManager;
use wor\lib\router\RequestContext;
use wor\lib\router\ResponseContext;
use wor\lib\router\Router;
use wor\util\JsonBuilder;

/**
 * Class SummerFramework
 *
 * @package wor\lib\app
 */
class SummerFramework
{
    private $controllerManager;

    public function __construct(ControllerManager $controllerManager)
    {
        $this->controllerManager = $controllerManager;
    }

    /**
     * @param $url
     * @param $method
     */
    public function run($url, $method)
    {
        $req = new RequestContext($url, $method);
        $res = new ResponseContext();

        try {
            $this->controllerManager->loadControllers(__ROOT__ . "/src/config/controller.php");
            Router::route($req, $res, $this->controllerManager->getMapper());
        } catch (ServerException $e) {
            $resBody = JsonBuilder::builder()
                ->setResult(0)
                ->setBody($e->getMessageBody())
                ->build();
            $res->setBody($resBody);
        }
        $res->send();
    }

    private function initialize()
    {
        #init




    }
}
