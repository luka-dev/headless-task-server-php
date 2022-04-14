<?php

namespace LuKa\HeadlessTaskServerPhp\Options;

use Exception;
use JsonSerializable;

class Viewport implements JsonSerializable
{
    /** @var int */
    private $width;

    /** @var int */
    private $height;

    /** @var int Default - 1 */
    private $deviceScaleFactor;

    /** @var int|null */
    private $screenWidth = null;

    /** @var int|null */
    private $screenHeight = null;

    /** @var int|null */
    private $positionX = null;

    /** @var int|null */
    private $positionY = null;

    public function __construct(int $width, int $height, int $deviceScaleFactor = 1)
    {
        if ($width < 1 || $height < 1) {
            throw new Exception('Incorrect Viewport width/height');
        }
        $this->width = $width;
        $this->height = $height;
        $this->deviceScaleFactor = $deviceScaleFactor;
    }

    /**
     * @return int|null
     */
    public function getScreenWidth(): ?int
    {
        return $this->screenWidth;
    }

    public function getScreenHeight(): ?int
    {
        return $this->screenHeight;
    }

    public function setScreen(int $screenWidth, int $screenHeight): void
    {
        $this->screenWidth = $screenWidth;
        $this->screenHeight = $screenHeight;
    }

    public function removeScreen(): void
    {
        $this->screenWidth = null;
        $this->screenHeight = null;
    }


    public function getPositionX(): ?int
    {
        return $this->positionX;
    }

    public function getPositionY(): ?int
    {
        return $this->positionY;
    }

    public function setPosition(?int $positionX, ?int $positionY): void
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    public function removePosition(): void
    {
        $this->positionX = null;
        $this->positionY = null;
    }

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function ($v) {
            return !is_null($v);
        });
    }
}