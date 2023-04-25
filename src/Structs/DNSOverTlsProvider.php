<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use JsonSerializable;

class DNSOverTlsProvider implements JsonSerializable
{
    /** @var string|null */
    private $host;

    /** @var string|null */
    private $servername;

    public function __construct(string $host = null, string $servername = null)
    {
        $this->host = $host;
        $this->servername = $servername;
    }

    public function jsonSerialize(): array
    {
        return [
            'host' => $this->host,
            'servername' => $this->servername,
        ];
    }
}