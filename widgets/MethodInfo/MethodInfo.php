<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/17/18
 * Time: 4:31 PM
 */

namespace app\widgets\MethodInfo;

use yii\base\Widget;
use yii\web\View;

class MethodInfo extends Widget
{
    private $methodType;

    public function init()
    {
        parent::init();
        MethodInfoAssets::register($this->getView());
        $this->methodType = $_SERVER['REQUEST_METHOD'];
    }

    public function run()
    {
        return $this->render('methodInfo', ['methodType' => $this->methodType]);
    }
}