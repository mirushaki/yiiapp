<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/24/18
 * Time: 7:46 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Orders extends ActiveRecord
{
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer_id']);
    }

    public function rules()
    {
        return [
            ['id', 'safe'],
            ['number', 'user_id', 'required'],
            ['number', 'string', 'max' => 16]
        ];
    }
}