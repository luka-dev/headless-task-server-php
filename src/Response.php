<?php

namespace LuKa\HeadlessTaskServerPhp;

use LuKa\HeadlessTaskServerPhp\Helpers\Timings;

class Response
{
    /** @var Timings */
    private $timings;

    /** @var string */
    private $session;

    /** @var string */
    private $status;

    /** @var string|null */
    private $error;

    /** @var mixed */
    private $output;

    /**
     * @param string $response
     * @throws \Exception
     */
    public function __construct(string $response)
    {
        try {
            $decoded = json_decode($response, false,512, JSON_THROW_ON_ERROR);
            $this->timings = new Timings($decoded->timings);

            $this->session = $decoded->session;
            $this->status = $decoded->status;
            $this->error = $decoded->error ?? null;
            $this->output = $decoded->output;
        }
        catch (\Throwable $e) {
            throw new \Exception('Bad response. Cant be parsed');
        }
    }

    public function getTimings(): Timings
    {
        return $this->timings;
    }

    public function getSession(): string
    {
        return $this->session;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }
}