<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 5:41 PM
 */

namespace app\controllers;


use app\models\User;
use app\models\Users;
use yii\db\Command;
use yii\db\Exception;
use yii\db\Query;
use yii\web\Controller;

class DataController extends Controller
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
        return $this->redirect(['data/users']);
    }

    public function actionAddUser()
    {
        return $this->redirect(['data/user-form']);
    }

    public function actionDeleteUser($id)
    {
        try {

            $usr = Users::findOne(['id' => $id]);

            Users::getDb()->transaction(function($db) use ($usr)
            {
                $usr->delete();
            });

            \Yii::$app->session->setFlash('message', 'The selected user has been deleted');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            return $this->redirect(['data/users']);
        }
        catch (\Throwable $e)
        {
            \Yii::$app->session->setFlash('message', 'Failed to delete selected user');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            Throw $e;
        }
    }


    public function actionUsers()
    {
        try
        {
            Users::getDb()->beginTransaction();
            try
            {
                $users = Users::find()->all();
                return $this->render('index', ['users' => $users]);
            }
            catch (\Exception $e)
            {
                throw $e;
            }
        }
        catch (Exception $e) {
            \Yii::$app->session->setFlash('message', 'Failed to get user list');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            throw new Exception('An unexpected error has occured');
        }
    }

    public function actionUserForm($id = null)
    {
        $request = \Yii::$app->request;

        $user = Users::findOne(['id' => $id]);

        if(!$user) {
            $user = new Users();
            $user->loadDefaultValues();
        }

        if($request->isGet) {
            return $this->render('userForm', ['user' => $user]);
        }
        else if($request->isPost)
        {
            if($user->load($request->post()) && $user->validate())
            {
                try
                {
                    if($user->isNewRecord)
                    {
                        \Yii::$app->session->setFlash('message', 'A new user has been created successfully!');
                        \Yii::$app->session->setFlash('message-class', 'alert-success');
                    }
                    else
                    {
                        \Yii::$app->session->setFlash('message', 'An existing user has been updated successfully!');
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
        return $this->redirect(['data/users']);
    }
}