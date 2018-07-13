<?php

namespace Lasarevs\Support\Traits;

/**
 * Trait Constantable
 *
 * @package Lasarevs\Support\Traits
 * @author  Sergey Lazarev <lazarews@gmail.com>
 */
trait Constantable
{
    /**
     * @param bool $flip
     *
     * @return array
     */
    public static function getConstants($flip = false) : array
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $flip ? array_flip($oClass->getConstants()) : $oClass->getConstants();
    }

    /**
     * @param string $needle
     * @param bool $flip
     * @param int $flag
     *
     * @return array
     */
    public static function getConstantsWith($needle, $flip = false, $flag = ARRAY_FILTER_USE_BOTH) : array
    {
        $oClass    = new \ReflectionClass(__CLASS__);
        $constants = $oClass->getConstants();
        $constants = array_filter(
            $constants,
            function ($value, $key) use ($needle) {
                return strpos(strtoupper($key), strtoupper($needle)) !== false;
            },
            $flag
        );

        return $flip ? array_flip($constants) : $constants;
    }
}
