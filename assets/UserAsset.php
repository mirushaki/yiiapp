<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/30/18
 * Time: 3:00 AM
 */

namespace app\assets;


use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = "@app/source-assets";

    public $js = [
        "js/user.js"
    ];

    public $jsOptions = [
        'position' => \Yii\web\View::POS_HEAD
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
}