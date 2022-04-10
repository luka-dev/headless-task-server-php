<?php

namespace LuKa\HeadlessTaskServerPhp;

use GeoLocation;
use JsonSerializable;

class Options implements JsonSerializable
{
    /** @var string|null */
    private $userAgent = null;

    /** @var ?GeoLocation */
    private $geoLocation = null;

    /** @var ?string use TZID from https://unicode-org.github.io/cldr-staging/charts/37/supplemental/zone_tzid.html */
    private $timezoneId = null;

    /** @var string|null example - "en-Us" */
    private $locale = null;

    /** @var \BlockedResourceTypes[]|null */
    private $blockedResourceTypes = null;

    /** @var string|null A socks5 or http proxy url (and optional auth). http://username:password@proxy.com:80 */
    private $upstreamProxyUrl = null;


    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    public function getGeoLocation(): ?GeoLocation
    {
        return $this->geoLocation;
    }

    public function setGeoLocation(?GeoLocation $geoLocation): void
    {
        $this->geoLocation = $geoLocation;
    }

    public function getTimezoneId(): ?string
    {
        return $this->timezoneId;
    }

    public function setTimezoneId(?string $timezoneId): void
    {
        $this->timezoneId = $timezoneId;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): void
    {
        $this->locale = $locale;
    }

    public function setBlockedResourceTypes(?array $blockedResourceTypes): void
    {
        $this->blockedResourceTypes = $blockedResourceTypes;
    }

    public function setUpstreamProxyUrl(?string $upstreamProxyUrl): void
    {
        $this->upstreamProxyUrl = $upstreamProxyUrl;
    }

    /**
     * string from const of BlockedResourceTypes::
     * @return \string[]|null
     */
    public function getBlockedResourceTypes(): ?array
    {
        return $this->blockedResourceTypes;
    }

    public function getUpstreamProxyUrl(): ?string
    {
        return $this->upstreamProxyUrl;
    }

    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}