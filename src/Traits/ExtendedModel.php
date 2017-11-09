<?php
/**
 * Created by PhpStorm.
 * User: crasher
 * Date: 10/10/17
 * Time: 3:16 PM
 */

namespace App\Traits;

use Carbon\Carbon;

/**
 * Trait ExtendedModel
 *
 * @package App\Traits
 * @author  Sergey Lazarev <sergey.lazarev@attractgroup.com>
 */
trait ExtendedModel
{
    public function getDateByName($name, $formatted = true, $default = null, $reserved = null, $noneText = '(None)')
    {
        $return = null;
        if ($this->{$name} != '0000-00-00') {
            $return = $this->{$name};
        }

        if ($return == null && $reserved != null) {
            $return = $this->getDateByName($reserved, false, $default);
        }

        if ($return == null && $default != null) {
            $return = $default;
        }

        if ($formatted) {
            return self::getFormattedDate($return, $noneText);
        } else {
            return $return;
        }
    }

    public function getDateByNameAndModify($name, $formatted = true, $default = null, $addDays = 0)
    {
        $return = Carbon::parse($this->getDateByName($name, false, $default));

        $return = $return->addDays($addDays);

        if ($formatted) {
            return self::getFormattedDate($return);
        } else {
            return $return;
        }
    }

    public function tryGetRelation($name, $key = null)
    {
        $data = $this->{$name};

        return $this->tryGetDataByKey($data, $key);
    }

    public function tryGetDataByKey($data, $key = null)
    {
        if(null != $data) {
            if(null != $key) {
                return is_object($data) ? $data->{$key} : $data[$key];
            } else {
                return $data;
            }
        } else {
            return null;
        }
    }
}