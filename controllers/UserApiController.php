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
use yii\data\DataFilter;
use yii\rest\ActiveController;
use yii\rest\Serializer;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class UserApiController extends ActiveController
{
    public $modelClass = Users::class;
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        /*$actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => $this->search()
        ];*/

        return $actions;
    }

    /*private function search()
    {
         return (new \yii\base\DynamicModel(['id' => null, 'firstName' => null, 'lastName' => null, 'eMail' => null]))
            ->addRule('id', 'integer')
            ->addRule('firstName', 'string')
            ->addRule('lastName', 'string')
            ->addRule('eMail', 'email');
    }*/

    public function behaviors()
    {
        $behaviors =  parent::behaviors();
        /*unset($behaviors['contentNegotiator']['formats']['application/xml']);*/
        return $behaviors;
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
                'pageSize' => 20
            ],
            'sort' => [
                'attributes' => [
                    'firstName',
                    'lastName',
                    'eMail'
                ],
                'enableMultiSort' => true,
            ]
        ]);
    }
}