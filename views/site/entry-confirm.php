<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/12/18
 * Time: 2:03 AM
 */

/* @var $model app\models\EntryForm */
use yii\helpers\Html;
$this->title = 'Entry';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-entry-confirm">
    <h1><?php echo Html::encode($this->title)?></h1>
    <h2>Info you entered</h2>
    <ul>
        <li><label>Name: </label><?php echo Html::encode($model->name)?></li>
        <li><label>Email: </label><?php echo Html::encode($model->email)?></li>
    </ul>
    <?php

    ?>
</div>
