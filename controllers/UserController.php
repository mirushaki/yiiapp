<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/25/18
 * Time: 6:24 PM
 */

namespace app\controllers;


use app\models\Users;
use Exception;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;

class UserController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function actionIndex()
    {
        try
        {
            $usersQuery = Users::find();

            $dataProvider = new ActiveDataProvider([
                'query' => Users::find(),
                'pagination' => [
                    'pageSize' => 2
                ],
                'sort' => [
                    'attributes' => [
                        'firstName',
                        'lastName'
                    ],
                    'enableMultiSort' => true,
                    'defaultOrder' => [
                        'lastName' => SORT_DESC
                    ]
                ]
            ]);

            /*$users = $usersQuery->offset($pagination->offset)
                ->limit($pagination->limit)
                ->orderBy($sort->orders)
                ->all();*/

            return $this->render('index', ['users' => $dataProvider->getModels(),'dataProvider' => $dataProvider]);
        }
        catch (Exception $e) {
            \Yii::$app->session->setFlash('message', 'Failed to get user list');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            throw $e;
        }
    }

    public function actionAdd()
    {
        return $this->redirect(['user/form']);
    }

    public function actionDelete($id)
    {
        try {
            Users::find()
                ->where(['id' => $id])
                ->one()
                ->delete();

            \Yii::$app->session->setFlash('message', 'The selected user has been deleted');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            return $this->redirect(['user/index']);
        }
        catch (\Throwable $e)
        {
            \Yii::$app->session->setFlash('message', 'Failed to delete selected user');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            Throw $e;
        }
    }

    public function actionForm($id = null)
    {
        $request = \Yii::$app->request;

        $user = Users::find()
            ->where(['id' => $id])
            ->one();

        if(!$user)
            $user = new Users();

        if($request->isGet) {
            return $this->render('form', ['user' => $user]);
        }
        else if($request->isPost)
        {
            if($user->load($request->post()) && $user->validate())
            {
                try
                {
                    if($user->isNewRecord)
                    {
                        \Yii::$app->session->setFlash('message', 'A new user has been created successfully');
                        \Yii::$app->session->setFlash('message-class', 'alert-success');
                    }
                    else
                    {
                        \Yii::$app->session->setFlash('message', 'an existing user has been updated successfully');
                        \Yii::$app->session->setFlash('message-class', 'alert-info');
                    }
                    $user->save();
                }
                catch (\Throwable $e) {
                    \Yii::$app->session->setFlash('message', 'Failed to add a new user!');
                    \Yii::$app->session->setFlash('message-class', 'alert-danger');
                    throw $e;
                }
            }
            else
            {
                \Yii::$app->session->setFlash('message', 'Failed to validate user! print_r($user->getErrors()');
                \Yii::$app->session->setFlash('message-class', 'alert-danger');
                throw new Exception('An unexpected error has occured');
            }
        }
        return $this->redirect(['user/index']);
    }
}