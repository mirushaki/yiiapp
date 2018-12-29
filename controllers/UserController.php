<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/25/18
 * Time: 6:24 PM
 */

namespace app\controllers;


use app\models\Users;
use app\models\UsersSearch;
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
            $usersSearch = new UsersSearch();
            $dataProvider = $usersSearch->Search(\Yii::$app->request->get('UsersSearch'));

            return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $usersSearch]);
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

    public function actionDelete($ids)
    {
        try {
            Users::deleteAll(['in', 'id', $ids]);

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