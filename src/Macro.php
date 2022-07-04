<?php

namespace DeathSatan\Macro;

use Closure;

trait Macro
{
    /**
     * @var Closure[]
     */
    protected static array $macro = [
        'static'=>[],
        'dynamic'=>[]
    ];

    public static function macro($name, Closure $closure,bool $is_static = true)
    {
        $type = $is_static?'static':'dynamic';
        static::$macro[$type][$name] = $closure;
    }

    public function __call($name, $arguments)
    {
        $dynamics = static::$macro['dynamic'];
        if (!empty($dynamics[$name]))
        {
            $closure = Closure::bind($dynamics[$name],$this);
            return $closure(...$arguments);
        }
        throw new \Error('Call to undefined method '.static::class.'::'.$name.'()');
    }

    public static function __callStatic($name, $arguments)
    {
        $statics = static::$macro['static'];
        if (!empty($statics[$name]))
        {
            $closure = Closure::bind($statics[$name],null,static::class);
            return $closure(...$arguments);
        }
        throw new \Error('Call to undefined method '.static::class.'::'.$name.'()');
    }
}