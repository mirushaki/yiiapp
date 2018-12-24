<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 6:26 PM
 */

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    // ActiveRecord should not have explicitly declared attributes
    /*
    public $id;
    public $firstName;
    public $lastName;
    public $eMail;
*/
    public static function tableName()
    {
        return '{{Users}}';
    }

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