<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/19/18
 * Time: 6:31 PM
 */

/** @var $order app\models\Orders */
/** @var $users [] */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Order Form';
?>
<div class="data-orderForm">
    <h1>Order</h1>
    <div style="width: 30%">
        <?php
        $form = ActiveForm::begin();
        echo $form->field($order, 'id')->hiddenInput()->label(false);
        echo $form->field($order, 'number');
        echo $form->field($order, 'user_id')->dropDownList($users);
        ?>
        <div class="form-group">
            <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
        </div>
        <?php
        $form::end();
        ?>
    </div>
</div>


