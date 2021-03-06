<?php

namespace Lasarevs\Support\Traits;

/**
 * Trait Flaggable
 *
 * @package Lasarevs\Support\Traits
 * @author  Sergey Lazarev <lazarews@gmail.com>
 */
trait Flaggable
{
    public function setFlag($flag, $field = 'flags')
    {
        $this->$field |= $flag;
    }

    public function removeFlag($flag, $field = 'flags')
    {
        $this->$field &= ~$flag;
    }

    public function checkFlag($flag, $field = 'flags')
    {
        $result = false;

        if ($this->$field) {
            if (($this->$field & $flag) == $flag) {
                $result = true;
            }
        }

        return $result;
    }

    public function extractFlags($field = 'flags')
    {
        $scan = 1;
        $result = [];
        while ($this->$field >= $scan) {
            if ($this->$field & $scan) {
                $result[] = $scan;
            }
            $scan <<= 1;
        }

        return $result;
    }
}
