<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/12/18
 * Time: 11:41 AM
 */

namespace app\models;

use yii\base\Model;

abstract class Calculator extends Model
{
    const ADD = 0;
    const SUBSTRACT = 1;
    const MULTIPLY = 2;
    const DIVIDE = 3;

    public static function getOperationAssocArray()
    {
        return array(
            self::ADD => 'Add (+)',
            self::SUBSTRACT => 'Substract (-)',
            self::MULTIPLY => 'Multiply (X)',
            self::DIVIDE => 'Divide (/)'
        );
    }

    public static function add($a, $b)
    {
        if(self::checkNumbers($a, $b))
            return round($a + $b, 3);
    }

    public static function substract($a, $b)
    {
        if(self::checkNumbers($a, $b))
            return $a - $b;
    }

    public static function multiply($a, $b)
    {
        if(self::checkNumbers($a, $b))
            return $a * $b;
    }

    public static function divide($a, $b)
    {
        if(self::checkNumbers($a, $b)) {
            if ($b == 0) {
                return "ERROR_DIVISION_BY_ZERO";
            }
            return round($a / $b, 3);
        }
    }

    private static function checkNumbers($a, $b)
    {
        if($a == null || $b == null)
            return false;
        else return true;
    }
}
