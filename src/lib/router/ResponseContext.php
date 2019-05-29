<?php

namespace wor\lib\Router;

/**
 * Class ResponseContext
 *  - 응답 메시지 관리
 */
class ResponseContext
{
    private $header;
    private $body;

    /**
     * - 응답 메시지 전송
     *
     * @return void
     */
    public function send()
    {
        $resType = gettype($this->body);
        if ($resType == "array" || $resType == "object") {
            header("Content-Type:application/json;charset=UTF-8");
            echo json_encode($this->body, JSON_UNESCAPED_UNICODE);
        } elseif ($resType == "string") {
            header("Content-Type: text/html;charset=UTF-8");
            require __ROOT__ . "/public/resource/view/" . $this->body;
        }
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
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
}
