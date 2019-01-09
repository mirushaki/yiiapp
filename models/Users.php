<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 6:26 PM
 */

namespace app\models;

use yii\helpers\Url;
use yii\db\ActiveRecord;
use yii\web\Link;
use yii\web\Linkable;

class Users extends ActiveRecord implements Linkable
{
    // ActiveRecord should not have explicitly declared attributes
    /*
    public $id;
    public $firstName;
    public $lastName;
    public $eMail;
*/

    public const ALL = 'All users';

    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['user_id' => 'id']);
    }

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

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['eMail']);
        return $fields;
    }

    public function extraFields()
    {
        return [
            'eMail'
        ];
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['user-api/view', 'id' => $this->id], true),
            'orders' => Url::to(['order-api/view', 'id' => $this->id], true)
        ];
    }
}