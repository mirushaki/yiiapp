<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/17/18
 * Time: 4:31 PM
 */

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class MethodInfo extends Widget
{
    private $width;
    private $height;
    private $fontSize;

    private $methodType;

    public function init()
    {
        parent::init();

        $this->width = 100;
        $this->height = 20;
        $this->fontSize  = 18;

        $this->methodType = $_SERVER['REQUEST_METHOD'];
    }

    public function run()
    {
        return "METHOD: <strong>$this->methodType</strong>";
    }
}