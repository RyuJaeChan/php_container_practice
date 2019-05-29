<?php

namespace wor\lib\exception;

use \Exception;

class ServerException extends Exception
{
    public function getMessageBody(): array
    {
        return [
            "code" => parent::getCode(),
            "message" => parent::getMessage()
        ];
    }
}
