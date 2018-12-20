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
    public $id;
    public $firstName;
    public $lastName;
    public $eMail;

    public function attributeLabels()
    {
        return [
            'id',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'eMail' => 'E-Mail'
        ];
    }

    public function rules()
    {
        return [
            ['id', 'safe'],
            [['firstName', 'lastName', 'eMail'], 'required'],
            [['firstName', 'lastName'], 'string', 'max' => 50],
            ['eMail', 'email']
        ];
    }
}