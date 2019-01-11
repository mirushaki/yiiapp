<?php

use yii\db\Migration;

/**
 * Class m190111_153225_init_rbac
 */
class m190111_153225_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;

        $viewUsersData = $auth->createPermission('viewUsersData');
        $viewUsersData->description = '"Users" data view';

        $modifyUsersData = $auth->createPermission('modifyUsersData');
        $modifyUsersData->description = '"Users" data modification';
        $auth->add($modifyUsersData);

        $regularUser = $auth->createRole('regularUser');
        $auth->add($regularUser);
        $auth->addChild($regularUser, $viewUsersData);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $modifyUsersData);
        $auth->addChild($admin, $regularUser);

        $auth->asign($admin, \app\models\User::USER_ADMIN);
        $auth->assign($regularUser, \app\models\User::USER_REGULAR);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();
    }
}
