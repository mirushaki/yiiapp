<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/9/19
 * Time: 5:33 PM
 */

namespace app\controllers;


use app\models\Users;
use app\models\UsersSearch;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class UserApiController extends ActiveController
{
    public $modelClass = "app\models\Users";

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if($action === 'delete')
        {
            throw new ForbiddenHttpException(sprintf("You cannot use %s", $action));
        }
    }

    public function prepareDataProvider()
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
            'query' => $query,
            'pagination' => [
                'pageSize' => 2
            ]
        ]);
    }
}