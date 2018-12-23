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

    public function actionDeleteUser($id)
    {
        $db = \Yii::$app->db;

        try {
            $db->open();
            $db->createCommand()->delete('Users', 'Id = :id', [':id' => $id])->execute();
            //$command = $db->createCommand("Delete From Users Where Id = $id");
            //$command->execute();
            $db->close();
            \Yii::$app->session->setFlash('message', 'The selected user has been deleted');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            return $this->redirect(['data/users']);
        }
        catch (Exception $e)
        {
            \Yii::$app->session->setFlash('message', 'Failed to delete selected user');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            //throw new Exception('An unexpected error has occured');
        }
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
            \Yii::$app->session->setFlash('message', 'Failed to get user list');
            \Yii::$app->session->setFlash('message-class', 'alert-danger');
            throw new Exception('An unexpected error has occured');
        }
    }

    public function actionUserForm($id = 0)
    {
        $request = \Yii::$app->request;
        $db = \Yii::$app->db;

        $user = new Users();

        if($request->isGet) {
            if ($id != 0) {
                $db = \Yii::$app->db;
                try {
                    $db->open();
                    $requestedUser = $db->createCommand("Select * From Users Where Id = :id")
                        ->bindValue(':id', $id)
                        ->queryOne();

                    if ($requestedUser) {
                        $user->id = $requestedUser['Id'];
                        $user->firstName = $requestedUser['firstName'];
                        $user->lastName = $requestedUser['lastName'];
                        $user->eMail = $requestedUser['eMail'];
                    }

                    $db->close();
                    return $this->render('userForm', ['user' => $user]);
                } catch (Exception $e) {
                }
            }
            else
            {
                return $this->render('userForm', ['user' => $user]);
            }


        }
        else if($request->isPost)
        {
            if($user->load($request->post()) && $user->validate())
            {
                try
                {
                    $db->open();
                    $requestedUser = false;
                    if(($user->id) && ($user->id != 0)) {
                        $requestedUser = $db->createCommand("Select * From Users Where Id = :id")
                            ->bindValue(':id', $id)
                            ->queryOne();
                    }
                    if($requestedUser)
                    {
                        $db->createCommand()->update('Users', [
                            'firstName' => $user->firstName,
                            'lastName' => $user->lastName,
                            'eMail' => $user->eMail
                        ], 'Id = :id', [':id' => $user->id])->execute();

                        //$db->createCommand("Update Users SET firstName='$user->firstName', lastName='$user->lastName',
                                                      //eMail='$user->eMail' WHERE Id = $user->id")->execute();
                        \Yii::$app->session->setFlash('message', 'An existing user has been updated successfully!');
                        \Yii::$app->session->setFlash('message-class', 'alert-info');
                    }
                    else
                    {
                        $db->createCommand()->insert('Users', [
                            'firstName' => $user->firstName,
                            'lastName' => $user->lastName,
                            'eMail' => $user->eMail]
                        )->execute();

                        //$db->createCommand("insert into Users(firstName, lastName, eMail)
                                        //values ('$user->firstName', '$user->lastName', '$user->eMail')")->execute();
                        \Yii::$app->session->setFlash('message', 'A new user has been updated successfully!');
                        \Yii::$app->session->setFlash('message-class', 'alert-success');
                    }
                    $db->close();
                }
                catch (Exception $e) {
                    \Yii::$app->session->setFlash('message', 'Failed to add a new user!');
                    \Yii::$app->session->setFlash('message-class', 'alert-danger');
                    throw new Exception('An unexpected error has occured');
                }
            }
            else
            {
                \Yii::$app->session->setFlash('message', 'Failed to validate user!');
                \Yii::$app->session->setFlash('message-class', 'alert-danger');
                throw new Exception('An unexpected error has occured');
            }
        }
        return $this->redirect(['data/users']);
    }
}