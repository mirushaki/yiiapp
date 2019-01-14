<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/9/19
 * Time: 5:33 PM
 */

namespace app\controllers;


use app\models\User;
use app\models\Users;
use app\models\UsersSearch;
use yii\data\ActiveDataFilter;
use yii\data\ActiveDataProvider;
use yii\data\DataFilter;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
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
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class
        ];
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view', 'options'],
                    'roles' => ['viewUsersData']
                ],
                [
                    'allow' => true,
                    'actions' => ['create', 'update', 'delete'],
                    'roles' => ['modifyUsersData']
                ],
            ]
        ];
        /*unset($behaviors['contentNegotiator']['formats']['application/xml']);*/
        return $behaviors;
    }

    /*public function checkAccess($action, $model = null, $params = [])
    {
        if($action !== 'index')
        {
            if(\Yii::$app->user->id != User::USER_ADMIN)
            {
                throw new ForbiddenHttpException(sprintf("Only administrator can use %s. USER_ID:%d", $action, \Yii::$app->user->getId()));
            }
        }
    }*/

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
                'pageSize' => 10
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