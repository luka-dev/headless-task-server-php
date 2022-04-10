<?php

namespace LuKa\HeadlessTaskServerPhp;

use JsonSerializable;

class Task implements JsonSerializable
{
    /** @var string */
    private $script;

    /** Send js from var or use static fromFile */
    public function __construct(string $script)
    {
        $this->script = $script;
    }

    /**
     * @param string $pathToFile
     * @return Task
     * @throws \Exception
     */
    public static function fromFile(string $pathToFile): Task
    {
        $script = file_get_contents($pathToFile);
        if ($script === false) {
            throw new \Exception('Not path to file');
        }

        return new Task($script);
    }

    public function jsonSerialize(): string {
        return $this->script;
    }
}