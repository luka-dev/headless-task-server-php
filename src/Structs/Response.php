<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

class Response {
    /** @var string on of ResponseStatuses */
    private $status;

    /** @var Timings */
    private $timings;

    /** @var Options */
    private $options;

    /** @var Profile*/
    private $profile;

    /** @var mixed */
    private $output;

    /** @var string|null */
    private $error;

    /**
     * @param string $response
     * @throws \Exception
     */
    public function __construct(string $response)
    {
        try {
            $decoded = json_decode($response, true,512, JSON_THROW_ON_ERROR);

            $this->status = $decoded['status'];
            $this->timings = new Timings($decoded['timings'] ?? []);
            $this->options = new Options($decoded['options']);
            $this->profile = new Profile($decoded['profile']);
            $this->output = $decoded['output'] ?? null;
            $this->error = $decoded['error'] ?? null;
        }
        catch (\Throwable $e) {
            var_dump($e);
            throw new \Exception('Bad response. Cant be parsed');
        }
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Timings
     */
    public function getTimings(): Timings
    {
        return $this->timings;
    }

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

}