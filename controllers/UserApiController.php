<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/9/19
 * Time: 5:33 PM
 */

namespace app\controllers;


use yii\rest\ActiveController;

class UserApiController extends ActiveController
{

    public $modelClass = "app\models\Users";

}