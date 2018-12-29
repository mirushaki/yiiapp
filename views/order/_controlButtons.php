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
        <div class="col-md-3">
            <?php echo Html::a('Add new order', ['order/add', 'userId' => ($user == Users::ALL) ? '' : $user->id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-3">
            <?php echo Html::a('Users', ['user/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>