<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use JsonSerializable;

class Profile implements JsonSerializable
{
    /** @var Cookie[] */
    private $cookies = [];

    /**
     * @description key - is domain url
     * @var Array<string, Storage>|null
     */
    private $storage = [];

    /** @var string|null */
    private $userAgentString = null;

    /** @var mixed|null */
    private $deviceProfile = null;

    /**
     * @throws \Exception
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'cookies':
                    foreach ($value as $cookie) {
                        $this->addCookie(new Cookie($cookie));
                    }
                    break;
                case 'storage':
                    foreach ($value as $url => $storage) {
                        $this->storage[$url] = new Storage($storage['indexedDB'], $storage['localStorage'], $storage['sessionStorage']);
                    }
                default:
                    if (property_exists(self::class, $key)) {
                        $this->{$key} = $value;
                    }
            }

        }
    }

    /**
     * @return Cookie[]|null
     */
    public function getAllCookies(): ?array
    {
        return $this->cookies;
    }

    public function addCookie(Cookie $cookie): void
    {
        $this->cookies[] = $cookie;
    }

    /** @param Cookie[]|null $cookie */
    public function setCookies(?array $cookie): void
    {
        $this->cookies[] = $cookie;
    }

    public function getUserAgentString(): ?string
    {
        return $this->userAgentString;
    }

    public function setUserAgentString(?string $userAgentString): void
    {
        $this->userAgentString = $userAgentString;
    }

    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}