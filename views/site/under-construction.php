<?php

use yii\helpers\Html;

$this->title = 'Under construction...';
?>
<div class="site-under-construction">
    <div class="alert alert-danger" style="text-align: center">
        <h1>The site is under construction!</h1>
    </div>
    <div style="text-align: center">
    <?php
    echo Html::img("/img/under-const.png", ['width' => 200, 'height' => 200])
    ?>
    </div>
</div>
