<?php

namespace app\widgets\LinkPager2;

use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/26/18
 * Time: 1:41 PM
 *
 * Description: Extends yii2 LinkPager widget
 * Add: totalRecordsLabelPrefix property, which displays '$totalRecordsLabelPrefix $this->pagination->totalCount'
 * as simple <p> tag text.
 *
 */

class LinkPager2 extends LinkPager
{
    public $totalRecordsLabelPrefix = false;

    private function renderTotalRecordsLabel()
    {
        return Html::tag("p", $this->totalRecordsLabelPrefix . ' ' . $this->pagination->totalCount);
    }
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        if($this->totalRecordsLabelPrefix)
            echo $this->renderTotalRecordsLabel();
    }
}