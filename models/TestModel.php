<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/14/18
 * Time: 2:04 PM
 */

namespace app\models;


use ReflectionClass;
use yii\base\Model;

class TestModel extends Model
{
    const SCENARIO_ALL = 0;
    const SCENARIO_FIRSTNAME_ONLY = 1;

    public $firstName;
    public $password;
    public static $number = 8;
    public static $anotherStaticNumber = 10;

    public function attributeLabels()
    {
        return array(
            'password' => 'PASSWORD'
        );
    }

    public function rules()
    {
        return array(
            ['firstName', 'required'],
            ['!password', 'string', 'min' => 6, 'max' => 10, 'on' => self::SCENARIO_ALL]
        );
    }

    //if scenarios() conflict with rules(), rules are applyed
    public function scenarios()
    {
        return array(
            self::SCENARIO_ALL => ['firstName', '!password'],
            self::SCENARIO_FIRSTNAME_ONLY => ['firstName']
        );
    }

}