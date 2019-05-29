<?php

namespace wor\util;

/**
 * Class ResponseJson
 *
 * @package wor\common
 */
class ResponseJson implements \JsonSerializable
{
    private $result;
    private $body;

    const SUCCESS = 1;
    const FAIL = 0;

    use JsonBuilder;

    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function setBody($body)
    {
        if (is_array($body)) {
            $this->body = [
                "size" => count($body),
                "list" => $body
            ];
        } else {
            $this->body = $body;
        }

        return $this;
    }

    public function build()
    {
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "result" => $this->result,
            "body" => $this->body
        ];
    }
}
