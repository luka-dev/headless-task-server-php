<?php

namespace LuKa\HeadlessTaskServerPhp\Options;

use JsonSerializable;

class UserProfile implements JsonSerializable
{
    /** @var Cookie[]|null */
    private $cookies = null;

    /** @var string|null  */
    private $userAgentString = null;

    //TODO add storage?: IDomStorage;
    //TODO add deviceProfile?: IDeviceProfile;

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

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}