<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 5:41 PM
 */

namespace app\controllers;


use app\models\Orders;
use app\models\Users;
use yii\db\Command;
use yii\db\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;
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
            Users::find()
                ->where('id = :id', [':id' => $id])
                ->one()
                ->delete();

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
            $users = Users::find()->all();
            return $this->render('index', ['users' => $users]);
        }
        catch (Exception $e) {
            \Yii::$app->session->setFlash('message', 'Failed to get user list');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            throw $e;
        }
    }

    public function actionUserForm($id = null)
    {
        $request = \Yii::$app->request;

        $user = Users::find()
            ->where(['id' => $id])
            ->one();

        if(!$user)
            $user = new Users();

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
        return $this->redirect(['data/users']);
    }

    public function actionOrders($userId = null)
    {
        if($userId)
            $orders = Orders::findAll(['user_id' => $userId]);
        else
            $orders = Orders::find()->all();
        return $this->render('orders', ['orders' => $orders]);
    }

    public function actionAddOrder($userId = null)
    {
        return $this->redirect(['data/order-form', 'userId' => $userId]);
    }

    public function actionDeleteOrder($id)
    {
        try {
            Orders::find()
                ->where(['id' => $id])
                ->one()
                ->delete();

            \Yii::$app->session->setFlash('message', 'The selected order has been deleted');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            return $this->redirect(['data/users']);
        }
        catch (\Throwable $e)
        {
            \Yii::$app->session->setFlash('message', 'Failed to delete selected order');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            Throw $e;
        }
    }

    public function actionOrderForm($id = null, $userId = null)
    {
        $request = \Yii::$app->request;

        $order = Orders::find()
            ->where(['id' => $id])
            ->one();

        $allUsers = Users::find()->all();
        $users = ArrayHelper::map($allUsers, 'id', 'firstName');

        if(!$order) {
            $order = new Orders();
            $order->user_id = $userId;
        }

        if($request->isGet) {
            var_dump($order->attributes);
            return $this->render('orderForm', ['order' => $order,'users' => $users]);
        }
        else if($request->isPost)
        {
            if($order->load($request->post()) && $order->validate())
            {
                try
                {
                    if($order->isNewRecord)
                    {
                        \Yii::$app->session->setFlash('message', 'A new order has been created successfully');
                        \Yii::$app->session->setFlash('message-class', 'alert-success');
                    }
                    else
                    {
                        \Yii::$app->session->setFlash('message', 'an existing order has been updated successfully');
                        \Yii::$app->session->setFlash('message-class', 'alert-info');
                    }
                    $order->save();
                }
                catch (\Throwable $e) {
                    \Yii::$app->session->setFlash('message', 'Failed to add a new order!');
                    \Yii::$app->session->setFlash('message-class', 'alert-danger');
                    throw $e;
                }
            }
            else
            {
                \Yii::$app->session->setFlash('message', 'Failed to validate order!');
                \Yii::$app->session->setFlash('message-class', 'alert-danger');
                throw new Exception('An unexpected error has occured');
            }
        }
        return $this->redirect(['data/orders']);
    }
}