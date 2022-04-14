<?php

namespace LuKa\HeadlessTaskServerPhp\Options;

use Exception;
use JsonSerializable;

class GeoLocation implements JsonSerializable
{
    /** @var float from -90 to 90 */
    private $latitude;

    /** @var float from -180 to 180 */
    private $longitude;

    /** @var int|null 1-100 Defaults to random number 40-50*/
    private $accuracy = null;

    public function __construct(float $latitude, float $longitude, ?int $accuracy = null)
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new Exception('$latitude has not acceptable value. Min -90, Max 90');
        }
        if ($longitude < -90 || $longitude > 90) {
            throw new Exception('$longitude has not acceptable value. Min -180, Max 180');
        }
        if (!is_null($accuracy) && $accuracy < 1) {
            throw new Exception('$accuracy has not acceptable value. Min 1. null - random');
        }

        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->accuracy = $accuracy;
    }

    public function jsonSerialize(): array
    {
       return [
           'latitude' => $this->latitude,
           'longitude' => $this->longitude,
           'accuracy' => $this->accuracy,
       ];
    }


}