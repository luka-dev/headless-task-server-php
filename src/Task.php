<?php

namespace LuKa\HeadlessTaskServerPhp;

use JsonSerializable;

class Task implements JsonSerializable
{
    /** @var string */
    private $script;

    /**
     * @var array
     */
    private $vars = [];

    /** @var bool */
    private $isVarsConst = true;


    /** Send js from var or use static fromFile */
    public function __construct(string $script, array $vars = [])
    {
        $this->script = $script;
        $this->vars = $vars;
    }

    /**
     * @param string $pathToFile
     * @param array $vars
     * @return Task
     * @throws \Exception
     */
    public static function fromFile(string $pathToFile, array $vars = []): Task
    {
        $script = file_get_contents($pathToFile);
        if ($script === false) {
            throw new \Exception('Not path to file');
        }

        return new Task($script, $vars);
    }

    public function defineVarsAsConst(bool $isVarsConst): void
    {
        $this->isVarsConst = $isVarsConst;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     * @throws \Exception
     */
    public function setVar(string $name, $value): void
    {
        if (in_array($name, ['agent'])) {
            throw new \Exception('this var name is reserved');
        }
        $this->vars[$name] = $value;
    }

    public function jsonSerialize(): string {
        $script = '';
        foreach ($this->vars as $name => $value)
        {
            $script .= ($this->isVarsConst ? 'const' : 'let') . ' ' . $name . ' = ' . json_encode($value) . PHP_EOL;
        }
        $script .= $this->script;
        return $script;
    }
}