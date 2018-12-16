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
    public $lastName;
    public $password;
    public $extraInfo;

    public function attributeLabels()
    {
        return [
            'password' => 'PASSWORD'
        ];
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'required'],
            ['!password', 'string', 'min' => 6, 'max' => 10, 'on' => self::SCENARIO_ALL]
        ];
    }

    //if scenarios() conflict with rules(), rules are applyed
    public function scenarios()
    {
        return [
            self::SCENARIO_ALL => ['firstName', 'lastName', 'extraInfo', '!password'],
            self::SCENARIO_FIRSTNAME_ONLY => ['firstName']
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        unset($fields['extraInfo']);

        return $fields;
    }

    public function extraFields()
    {
        return [
            'fullName' => function() {
                return $this->firstName . ' ' . $this->lastName;
            }
        ];
    }
}