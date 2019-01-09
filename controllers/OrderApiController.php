<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/9/19
 * Time: 5:57 PM
 */

namespace app\controllers;


use yii\rest\ActiveController;

class OrderApiController extends ActiveController
{
    public $modelClass = "app\models\Orders";
}