<?php

namespace wor\lib\Router;

/**
 * Class RequestContext
 *  - 요청 메시지 정보 관리
 */
class RequestContext
{
    private $url;
    private $method;
    private $body;

    /**
     * RequestContext constructor.
     * - 기본 생성자
     * - 서버 parameter 저장
     *
     * @param string $url
     * @param string $method
     */
    public function __construct(string $url, string $method)
    {
        $this->url      = $url;
        $this->method   = $method;
        $this->body     = json_decode(file_get_contents("php://input"));
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getFileInfo()
    {
        return $_FILES;
    }

    /**
     * @return mixed
     */
    public function getGetParameter()
    {
        return $_GET;
    }

    /**
     * @return mixed
     */
    public function getPostParameter()
    {
        return $_POST;
    }

    /**
     * @return mixed
     */
    public function getCookie()
    {
        return $_COOKIE;
    }
}
