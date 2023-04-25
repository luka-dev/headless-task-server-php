<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use DateTime;
use DateTimeZone;

class Timings
{
    /** @var DateTime|null */
    private $beginAt;

    /** @var DateTime|null */
    private $endAt;

    /** @var DateTime|null */
    private $createdAt;

    public function __construct(array $timings = [])
    {
        try {
            if ($timings['begin_at'] !== null) {
                $this->beginAt = new DateTime($timings['begin_at'], new DateTimeZone('UTC'));
            }
        } catch (\Throwable $e) {
            $this->beginAt = null;
        }

        try {
            if ($timings['end_at'] !== null) {
                $this->endAt = new DateTime($timings['end_at'], new DateTimeZone('UTC'));
            }
        } catch (\Throwable $e) {
            $this->endAt = null;
        }

        try {
            if ($timings['end_at'] !== null) {
                $this->createdAt = new DateTime($timings['created_at'], new DateTimeZone('UTC'));
            }
        } catch (\Throwable $e) {
            $this->createdAt = null;
        }
    }

    public function getBeginAt(): ?DateTime
    {
        return $this->beginAt;
    }

    public function getEndAt(): ?DateTime
    {
        return $this->endAt;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

}