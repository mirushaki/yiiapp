<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/17/18
 * Time: 1:58 PM
 */

namespace app\components;


use yii\base\ActionFilter;

class dummyFilter extends ActionFilter
{
    private $_startTime;

    public function beforeAction($action)
    {
        $this->_startTime = microtime(true);
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $time = microtime(true) - $this->_startTime;
        \Yii::debug("\'{$action->uniqueId}\' spent $time second.");
        return parent::afterAction($action, $result);
    }
}