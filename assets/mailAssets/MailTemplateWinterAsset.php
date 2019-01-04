<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/4/19
 * Time: 1:31 PM
 */

namespace app\assets\mailAssets;


use yii\web\AssetBundle;

class MailTemplateWinterAsset extends AssetBundle
{
    public $sourcePath = "@app/source-assets/mail-template-assets/winter";

    public $css = [
        'css/template.css'
    ];
}