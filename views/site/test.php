<?php

/* @var $this yii\web\View */
/* @var $fileContents string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $fileContents ?>

   <?php
   $form = ActiveForm::begin([
    'id' => 'login-form',
    'method' => 'post',
    'options' => ['class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'],
    ]);

    echo Html::input('file', 'file');
   ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Upload File', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>
