<?php

namespace wor\lib\mvc;

use wor\lib\router\RequestContext;
use wor\lib\router\ResponseContext;
use wor\lib\exception\ServerException;

/**
 * Class ControllerManager
 *  - 사용자 정의 controller 목록을 유지
 *
 * @package wor\lib\mvc
 */
class ControllerManager
{
    private $mapper = [];

    /**
     * - 요청 처리하기 위한 controller 등록
     *
     * @param $dir
     *
     * @throws ServerException
     */
    public function loadControllers($dir)
    {
        try {
            $config = require $dir;

            $namespace = $config["namespace"];
            $controllerList = $config["controllerList"];

            foreach ($controllerList as $className) {
                $class = $namespace . $className;

                #container에서 가져오도록 수정해야하지 않을까????
                $controller = new $class;

                if ($controller instanceof Controller) {
                    $this->register($controller);
                }
            }
        } catch (\Exception $e) {
            throw new ServerException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * * - url과 controller 등록
     *
     * @param $obj Controller Controller를 상속받아 생성한 사용자 정의 controller
     *
     * @throws \ReflectionException
     */
    private function register(Controller $obj)
    {
        $reflClass = new \ReflectionClass($obj);

        $annoPattern = "/@(.*)\((.+)\)/u";
        $urlPattern = "/url=\"(.*)\"/u";

        $methods = $reflClass->getMethods();

        foreach ($methods as $method) {
            $doc = $method->getDocComment();
            preg_match($annoPattern, $doc, $matches);

            if (!$matches) {
                continue;
            }

            $annotationName = $matches[1];

            $reqMethod = "GET";
            if ($annotationName == "PostMapping") {
                $reqMethod = "POST";
            }

            $out = array();
            preg_match($urlPattern, $matches[2], $out);
            $url = $out[1];

            $pathInfo = $this->parsePathInfo($url);

            #controller의 요청 처리 clousure 등록
            $this->mapper[] = [
                "pattern" => $pathInfo["pattern"],
                $reqMethod => $method->getClosure($obj),
                "variableIndex" => $pathInfo["pathVariable"],
                "instance" => $obj
            ];
        }
    }

    /**
     * - 사용자가 정의한 url에서 path variable을 추출하고 패턴을 정규표현식으로 변경
     *
     * @param string $urlPattern : 사용자 입력 url 패턴
     *
     * @return array : path 정보를 담은 연관 배열
     */
    private function parsePathInfo(string $urlPattern) : array
    {
        $urlToken = explode("/", $urlPattern);
        array_shift($urlToken); //remove first blank element

        $variableIndex = [];
        $pattern = "/";

        $index = 0;
        foreach ($urlToken as $token) {
            if (preg_match("/<\D*:\D+\d*>$/u", $token)) { //<var_name:type_name>
                $temp = substr($token, 1, strlen($token) - 2);
                $p = explode(":", $temp);
                $variableIndex[] = $index;

                if ($p[1] == "string") {
                    $pattern .= "\/\w*";
                } elseif ($p[1] == "int") {
                    $pattern .= "\/\d*";
                }
            } else {
                $pattern .= "\/" . $token;
            }
            $index++;
        }
        $pattern .= "$/u";

        $pathInfo = [];
        $pathInfo["pattern"] = $pattern;
        $pathInfo["pathVariable"] = $variableIndex;
        return $pathInfo;
    }

    /**
     * @return array
     */
    public function getMapper(): array
    {
        return $this->mapper;
    }
}
