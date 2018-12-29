<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/30/18
 * Time: 12:31 AM
 */

use app\models\Users;
use yii\helpers\Html;

/** @var $user app\models\Users */

?>
<div class="control-buttons">
    <div class="row">
        <div class="col-md-2">
            <?php echo Html::a('Add new user', ['user/add'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-2">
            <?php echo Html::a('Show all orders', ['order/index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>