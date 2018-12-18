<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/17/18
 * Time: 6:20 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class CustomAsset extends AssetBundle
{
    public $sourcePath = "@app/source-assets";

    public $css = [
        "css/custom-site.css"
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
}