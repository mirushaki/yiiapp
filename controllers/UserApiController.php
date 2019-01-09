<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/9/19
 * Time: 5:33 PM
 */

namespace app\controllers;


use app\models\Users;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class UserApiController extends ActiveController
{

    public $modelClass = "app\models\Users";

    public function actionIndex()
    {
        $filter = new ActiveDataFilter([
            'searchModel' => 'app\models\UsersSearch'
        ]);
        $filterCondition = null;

        if($filter->load(\Yii::$app->request->get()))
        {
            $filterCondition = $filter->build();
            if($filterCondition === false)
            {
                return $filter;
            }
        }

        $query = Users::find();

        if($filterCondition !== null)
        {
            $query->andWhere($filterCondition);
        }

        return new ActiveDataProvider([
            'query' => Users::find(),
        ]);
    }
}