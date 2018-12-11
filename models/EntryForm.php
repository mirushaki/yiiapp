<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/12/18
 * Time: 1:45 AM
 */

namespace app\models;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email']
        ];
    }
}