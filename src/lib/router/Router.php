<?php

namespace wor\lib\router;

use wor\lib\exception\ServerException;

/**
 * Class Router
 *  - 요청을 처리하고 응답 메시지 생성
 *
 * @package wor\lib\router
 */
class Router
{
    /**
     * - 요청을 처리
     *
     * @param RequestContext $req   요청 정보
     * @param ResponseContext $res  응답 정보 참조
     * @param array $mapper         url과 action을 매핑한 배열
     *
     * @throws ServerException
     */
    public static function route(RequestContext $req, ResponseContext &$res, array $mapper)
    {
        if (!$req instanceof RequestContext
            and !$res instanceof ResponseContext
        ) {
            throw new ServerException("Server Error : 인자가 올바르지 않습니다.", 1);
        }

        foreach ($mapper as $controllerInfo) {
            if (preg_match($controllerInfo["pattern"], $req->getUrl())) {
                $closure = $controllerInfo[$req->getMethod()];
                if ($closure) {
                    $controllerInfo["instance"]->setRequestContext($req);
                    $pathVariable = self::getPathVariables($req->getUrl(), $controllerInfo["variableIndex"]);
                    self::callFunction($closure, $pathVariable, $res);

                    return;
                }
            }
        }

        throw new ServerException("Bad Request", 20001);
    }

    /**
     *  - Url 패턴과 Request Method가 일치하는 것 실행
     *
     * @param callable $action
     * @param array $pathVariable
     * @param ResponseContext $res
     */
    private static function callFunction(callable $action, array $pathVariable, ResponseContext &$res)
    {
        #$ret = call_user_func_array($action, $pathVariable);
        $ret = $action(... $pathVariable);
        $res->setBody($ret);
    }

    /**
     * - url에 있는 path variable 추출
     *
     * @param string $url
     * @param array $pathVariableIndex
     *
     * @return array
     */
    private static function getPathVariables(string $url, array $pathVariableIndex) : array
    {
        $pathTokens = explode("/", $url);
        array_shift($pathTokens);

        $pathVariable = array();
        foreach ($pathVariableIndex as $it) {
            $pathVariable[] = $pathTokens[$it];
        }

        return $pathVariable;
    }
}
