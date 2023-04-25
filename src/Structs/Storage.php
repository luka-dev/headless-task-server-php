<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

class Storage implements \JsonSerializable
{
    /** @var mixed[] */
    private $indexedDB;

    /**
     * @description each element is 2 element array where first element - key, second - value
     * @var Array<string[]>
     */
    private $localStorage;

    /**
     * @description each element is 2 element array where first element - key, second - value
     * @var Array<string[]>
     */
    private $sessionStorage;

    /**
     * @param mixed[] $indexedDB
     * @param Array<string[]> $localStorage see property description
     * @param Array<string[]> $sessionStorage see property description
     */
    public function __construct(array $indexedDB = [], array $localStorage = [], array $sessionStorage = [])
    {
        $this->indexedDB = $indexedDB;
        $this->localStorage = $localStorage;
        $this->sessionStorage = $sessionStorage;
    }

    public function jsonSerialize(): array
    {
        return [
            'indexedDB' => $this->indexedDB,
            'localStorage' => $this->localStorage,
            'sessionStorage' => $this->sessionStorage,
        ];
    }
}