<?php

namespace wor\lib\module;

/**
 * Class Module
 * - 모듈의 베이스 클래스
 *
 * @package wor\lib\module
 */
abstract class Module
{
    abstract public function prev();
    abstract public function post();
    final public function getModule(callable $action, array $param = [])
    {
        return (function () use ($action, $param) {
            $this->prev();
            $ret = $action(... $param);
            $this->post();
            return $ret;
        })->bindTo($this);
    }
}
