<?php

namespace wor\lib\mvc;

use wor\lib\router\RequestContext;

/**
 * Class Controller
 *  - Controller 정의를 위한 상위 클래스
 *
 * @package wor\lib\mvc
 */
abstract class Controller
{
    private $reqContext;

    /**
     * - request context 반환
     *
     * @return RequestContext
     */
    protected function getRequestContext()
    {
        return $this->reqContext;
    }

    public function setRequestContext($reqContext)
    {
        $this->reqContext = $reqContext;
    }
}
