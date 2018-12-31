<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/31/18
 * Time: 2:46 PM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\base\View */
/** @var $model app\models\UsersSearch */
/** @var $form yii\widgets\ActiveForm */
?>
<div class="users-search">
    <h2 style="text-align: center">Search criteria</h2>
    <?php $form = ActiveForm::begin(
        [
            'action' => ['index'],
            'method' => 'get'
        ]);

    echo $form->field($model, 'id');
    echo $form->field($model, 'firstName');
    echo $form->field($model, 'lastName');

    ?>
    <div class="form-group">
        <?php
            echo Html::submitButton('Search', ['class' => 'btn btn-primary']);
            echo Html::resetButton('Reset', ['class' => 'btn btn-secondary', 'style' => ['margin-left' => '10px']]);
        ?>
    </div>

    <?php ActiveForm::end() ?>
</div>