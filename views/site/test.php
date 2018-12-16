<?php
/* @var $this yii\web\View */
/* @var $model app\models\TestModel */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    $form = Activeform::begin();

    echo $form->field($model, 'firstName');
    echo $form->field($model, 'password')->input('password');

    ?>
    <div class="form-group">
        <?php echo Html::submitButton("Save Info", ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end();


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        echo "METHOD: POST";
    }
    else if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        echo "METHOD: GET";
    }
    echo "<pre>";
    print_r($model->attributes);
    echo "</pre>";
    ?>
</div>
