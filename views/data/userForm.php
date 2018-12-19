<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 6:31 PM
 */

/** @var $user app\models\Users */
/** @var $mm [] */

use app\models\Users;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'User Form';
?>
<div class="data-userForm">
    <h1>User</h1>
    <div style="width: 30%">
    <?php
        $form = ActiveForm::begin();
        echo $form->field($user, 'firstName');
        echo $form->field($user, 'lastName');
        echo $form->field($user, 'eMail');
    ?>
    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
    </div>
    <?php
        $form::end();
        if(Yii::$app->session->hasFlash('message'))
        {
            echo Alert::widget([
                'options' => ['class' => 'alert-info'],
                'body' => Yii::$app->session->getFlash('message')
            ]);
        }
    ?>
    </div>
</div>


