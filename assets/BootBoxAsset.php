<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/20/18
 * Time: 10:36 PM
 */

namespace app\assets;


use Yii;
use yii\web\AssetBundle;

class BootBoxAsset extends AssetBundle
{
    public $sourcePath = "@vendor/bower-asset/bootbox";

    public $js = [
        'bootbox.js'
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
    public static function overrideSystemConfirm()
    {
        Yii::$app->view->registerJs("
            yii.confirm = function(message, ok, cancel) {
                bootbox.confirm({
                message: 'Do you want to delete the selected user?',
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                        },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback : function(result) {
                    if (result) { !ok || ok(); } else { !cancel || cancel(); }
                }
                
                });
            }
        ");
    }
}