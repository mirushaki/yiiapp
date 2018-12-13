<?php

namespace app\actions;
use yii\base\Action;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/13/18
 * Time: 6:58 PM
 */


class DummyAction extends Action
{
    public $prop1;
    public $prop2;

    public function run($prop1 = 'default 1', $prop2 = 'default 2')
    {
        $this->prop1 = $prop1;
        $this->prop2 = $prop2;
        return $this->controller->render('dummy', ['prop1' => $this->prop1, 'prop2' => $this->prop2]);
    }
}