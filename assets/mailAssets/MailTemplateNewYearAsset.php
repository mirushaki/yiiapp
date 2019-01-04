<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/4/19
 * Time: 11:50 AM
 */

namespace app\assets\mailAssets;


use yii\web\AssetBundle;

class MailTemplateNewYearAsset extends AssetBundle
{
    public $sourcePath = '@app/source-assets/mail-template-assets/new-year';

    public $css = [
        'css/template.css'
    ];

    public $cssOptions = [
        'position' => \yii\web\View::POS_BEGIN
    ];
/*
    public $publishOptions = [
        'forceCopy' => true,
        'afterCopy' => self::onAfterCopy($from, $to)
    ];*/
}