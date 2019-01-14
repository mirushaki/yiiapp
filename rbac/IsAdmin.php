<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/14/19
 * Time: 11:55 AM
 */
namespace app\rbac;



use app\models\User;
use yii\rbac\Item;
use yii\rbac\Rule;

class IsAdmin extends Rule
{

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return $user == User::USER_ADMIN;
    }
}