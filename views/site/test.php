<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    table {
        collapse: collapse;
        text-align: center;
    }
    thead {
        background-color: #333333;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #9d9d9d;
    }
    td
    {
        border: 1px solid black;
        padding: 5px;
    }

</style>


<div class="site-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php

    echo "<pre>";
    echo "</pre>";
    ?>
</div>
