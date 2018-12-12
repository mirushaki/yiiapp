<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/12/18
 * Time: 1:59 AM
 */

/* @var $a int */
/* @var $b int */
/* @var $operations array */
/* @var $result string */
/* @var $currentOperation int */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Calculator';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-entry">
    <h1><?php echo Html::encode($this->title)?></h1>
    <?php $form = Activeform::begin() ?>
    <div style="width: 15%">
    <div class="form-group">
        <?php echo Html::input('number', 'a', $a, ['class' => 'form-control', 'step' => 0.001]); ?>
    </div>
    <div class="form-group">
        <?php echo Html::input('number', 'b', $b, ['class' => 'form-control', 'step' => 0.001]); ?>
    </div>
    <div class="form-group">
        <?php echo Html::dropDownList('operations', $currentOperation ?: null, $operations, ['class' => 'form-control']); ?>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton("Calculate", ['class' => 'btn btn-primary']); ?>
    </div>
    </div>
    <br>
<?php ActiveForm::end();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($result != null)
        echo "RESULT: " . "<b>$result</b>";
}
?>
</div>