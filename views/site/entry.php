<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/12/18
 * Time: 1:59 AM
 */

/* @var $model app\models\EntryForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Entry';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-entry">
    <h1><?php echo Html::encode($this->title)?></h1>
<?php
    $form = Activeform::begin();
    echo $form->field($model, 'name');
    echo $form->field($model, 'email');
?>
    <div class="form-group">
        <?php echo Html::submitButton("Save", ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>