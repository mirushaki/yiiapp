<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 6:26 PM
 */

namespace app\models;


use yii\base\Model;

class Users extends Model
{
    public $firstName;
    public $lastName;
    public $eMail;

    public function attributeLabels()
    {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'eMail' => 'E-Mail'
        ];
    }

    public function rules()
    {
        return [
            [['firstName', 'lastName', 'eMail'], 'required'],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            ['eMail', 'email']
        ];
    }
}