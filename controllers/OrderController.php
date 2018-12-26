<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/25/18
 * Time: 6:39 PM
 */

namespace app\controllers;


use app\models\Orders;
use app\models\Users;
use Exception;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class OrderController extends Controller
{
    private const PAGE_SIZE = 5;
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }
    public function actionIndex($userId = null)
    {
        $ordersQuery = Orders::find();

        if($userId) {
            $user = Users::findOne(['id' => $userId]);

            $pagination = new Pagination([
                'totalCount' => $ordersQuery->where(['user_id' => $userId])->count(),
                'pageSize' => self::PAGE_SIZE
            ]);

            $orders = $ordersQuery->offset($pagination->offset)
                ->limit($pagination->limit)
                ->where(['user_id' => $userId])
                ->all();
        }
        else {
            $user = Users::ALL;

            $pagination = new Pagination([
                'totalCount' => $ordersQuery->count(),
                'pageSize' => self::PAGE_SIZE
            ]);

            $orders = $ordersQuery->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }

        return $this->render('index', ['orders' => $orders, 'user' => $user, 'pagination' => $pagination]);
    }

    public function actionAdd($userId = null)
    {
        return $this->redirect(['order/form', 'userId' => $userId]);
    }

    public function actionDelete($id)
    {
        try {
            Orders::find()
                ->where(['id' => $id])
                ->one()
                ->delete();

            \Yii::$app->session->setFlash('message', 'The selected order has been deleted');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            return $this->redirect(['order/index']);
        }
        catch (\Throwable $e)
        {
            \Yii::$app->session->setFlash('message', 'Failed to delete selected order');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            Throw $e;
        }
    }

    public function actionForm($id = null, $userId = null)
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
            return $this->render('form', ['order' => $order,'users' => $users]);
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
        return $this->redirect(['order/index']);
    }

}