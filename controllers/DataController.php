<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 5:41 PM
 */

namespace app\controllers;


use app\models\Users;
use yii\db\Command;
use yii\db\Exception;
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

    public function actionUsers()
    {
        $db = \Yii::$app->db;
        try
        {
            $db->open();
            $users = $db->createCommand('Select * From Users')->queryAll();
            $db->close();
            return $this->render('index', ['users' => $users]);
        }
        catch (Exception $e) {
        }

        return $this->render('index', ['users' => ['error' => 'An error occured']]);
    }

    public function actionUserForm($id = 0)
    {
        $request = \Yii::$app->request;
        $db = \Yii::$app->db;

        $user = new Users();

        if($id != 0)
        {
            $db = \Yii::$app->db;
            try
            {
                $db->open();
                $users = $db->createCommand('Select * From Users')->queryAll();




                $db->close();
                return $this->render('index', ['users' => $users]);
            }
            catch (Exception $e) {
            }
        }


        if($request->isPost)
        {
            if($user->load($request->post()) && $user->validate())
            {
                try
                {
                    $db->open();
                    $command = $db->createCommand("insert into Users(firstName, lastName, eMail)
                                                values ('$user->firstName', '$user->lastName', '$user->eMail')");
                    $command->execute();
                    $db->close();
                    \Yii::$app->session->setFlash('message', 'A new user has been successfully added!');
                }
                catch (Exception $e) {
                    \Yii::$app->session->setFlash('message', 'Failed to add a new user!');
                    throw new Exception($e);
                }
            }
            else
            {
                \Yii::$app->session->setFlash('message', 'Failed to add a new user!');
                throw new Exception('An unexpected error has occured');
            }
        }
        return $this->render('userForm', ['user' => $user]);
    }
}