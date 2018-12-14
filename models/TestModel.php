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
    public $checkboxItems;
    public $dropdownItems = [
        1 => 'item 1',
        2 => 'item 2'
    ];
    public $radioItems;

    public function attributeLabels()
    {
        return [
            'password' => 'PASSWORD'
        ];
    }

    public function rules()
    {
        return [
            ['firstName', 'required'],
            ['!password', 'required', 'on' => self::SCENARIO_ALL],
            ['!password', 'string', 'length' => [6,10], 'on' => self::SCENARIO_ALL]
        ];
    }

    //if scenarios() conflict with rules(), rules are applyed
    public function scenarios()
    {
        return [
            self::SCENARIO_ALL => ['firstName', '!password'],
            self::SCENARIO_FIRSTNAME_ONLY => ['firstName']
        ];
    }
}