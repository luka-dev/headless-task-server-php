<?php

namespace LuKa\HeadlessTaskServerPhp\Structs;

use JsonSerializable;

class Task implements JsonSerializable
{
    private static $reservedVars = [
        //HeadlessTaskServer reserved vars
        'agent',

        //JS reserved vars
        'abstract', 'arguments', 'await', 'boolean', 'break', 'byte', 'case', 'catch', 'char', 'class', 'const',
        'continue', 'debugger', 'default', 'delete', 'do', 'double', 'else', 'enum*', 'eval', 'export', 'extends',
        'false', 'final', 'finally', 'float', 'for', 'function', 'goto', 'if', 'implements', 'import', 'in',
        'instanceof', 'int', 'interface', 'let', 'long', 'native', 'new', 'null', 'package', 'private', 'protected',
        'public', 'return', 'short', 'static', 'super', 'switch', 'synchronized', 'this', 'throw', 'throws',
        'transient', 'true', 'try', 'typeof', 'var', 'void', 'volatile', 'while', 'with', 'yield'
    ];

    /** @var string */
    private $script;

    /**
     * @description php assoc array of key => value, where key is var name.
     * @var array<string, string|int|float|double|boolean|null>
     */
    private $vars = [];

    /**
     * @description php assoc array of key => value, where key is var name.
     * @var array<string, string|int|float|double|boolean|null>
     */
    private $consts = [];

    /** Send js from var or use static fromFile */
    public function __construct(string $script)
    {
        $this->script = $script;
    }

    /**
     * @param string $pathToFile
     * @param array $vars
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

    /**
     * @param string $name
     * @param $value
     * @return void
     * @throws \Exception
     */
    public function setVar(string $name, $value): void
    {
        if (in_array($name, self::$reservedVars)) {
            throw new \Exception('this let name is reserved');
        }
        $this->vars[$name] = $value;
    }

    /**
     * @param string $name
     * @param $value
     * @return void
     * @throws \Exception
     */
    public function setConst(string $name, $value): void
    {
        if (in_array($name, self::$reservedVars)) {
            throw new \Exception('this const name is reserved');
        }
        $this->consts[$name] = $value;
    }

    public function jsonSerialize(): string {
        $script = '';
        foreach ($this->consts as $name => $value) {
            $script .= 'const ' . $name . ' = ' . json_encode($value) . PHP_EOL;
        }
        foreach ($this->vars as $name => $value) {
            $script .= 'let ' . $name . ' = ' . json_encode($value) . PHP_EOL;
        }
        $script .= $this->script;
        return $script;
    }
}