<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use JsonSerializable;

class Cookie implements JsonSerializable
{
    /** @var string */
    private $name = null;

    /** @var string */
    private $value = null;

    /** @var null|string */
    private $domain = null;

    /** @var null|string */
    private $path = null;

    /** @var null|string */
    private $expires = null;

    /** @var null|bool */
    private $httpOnly = null;

    /** @var null|bool */
    private $secure = null;

    /** @var null|string */
    private $sameSite = null;

    /** @var boolean|null */
    private $sameParty = null;

    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? null;
        $this->value = $data['value'] ?? null;
        $this->setSecure($data['secure'] ?? null);
        $this->setSameSite($data['sameSite'] ?? null);
        $this->setSameParty($data['sameParty'] ?? null);
        $this->setExpires($data['expires'] ?? null);
        $this->setHttpOnly($data['httpOnly'] ?? null);
        $this->setPath($data['path'] ?? null);
        $this->setDomain($data['domain'] ?? null);
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

    /**
     * @return bool|null
     */
    public function getSameParty(): ?bool
    {
        return $this->sameParty;
    }

    /**
     * @param bool|null $sameParty
     */
    public function setSameParty(?bool $sameParty): void
    {
        $this->sameParty = $sameParty;
    }

    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}