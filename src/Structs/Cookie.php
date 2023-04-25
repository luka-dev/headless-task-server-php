<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use JsonSerializable;

class Cookie implements JsonSerializable
{
    /** @var string */
    private $name;

    /** @var string */
    private $value;

    /** @var null|string */
    private $domain = null;

    /** @var null|string */
    private $url = null;

    /** @var null|string */
    private $path = null;

    /** @var null|string */
    private $expires = null;

    /** @var null|bool */
    private $httpOnly = null;

    /** @var null|bool */
    private $session = null;

    /** @var null|bool */
    private $secure = null;

    /** @var null|string */
    private $sameSite = null;

    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = (string)$value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): void
    {
        $this->domain = $domain;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    public function getExpires(): ?string
    {
        return $this->expires;
    }

    public function setExpires(?string $expires): void
    {
        $this->expires = $expires;
    }

    public function getHttpOnly(): ?bool
    {
        return $this->httpOnly;
    }

    public function setHttpOnly(?bool $httpOnly): void
    {
        $this->httpOnly = $httpOnly;
    }

    public function getSession(): ?bool
    {
        return $this->session;
    }

    public function setSession(?bool $session): void
    {
        $this->session = $session;
    }

    public function getSecure(): ?bool
    {
        return $this->secure;
    }

    public function setSecure(?bool $secure): void
    {
        $this->secure = $secure;
    }

    public function getSameSite(): ?string
    {
        return $this->sameSite;
    }

    /**
     * @param string|null $sameSite
     * @return void
     * @throws \Exception
     */
    public function setSameSite(?string $sameSite): void
    {
        if (is_null($sameSite) || in_array($sameSite, ['Strict', 'Lax', 'None'])) {
            $this->sameSite = $sameSite;
        } else {
            throw new \Exception('Incorrect sameSite value');
        }
    }

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}