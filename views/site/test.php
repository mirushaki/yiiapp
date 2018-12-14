<?php
/* @var $this yii\web\View */
/* @var $model app\models\TestModel */
/* @var $data array */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    div.required label.control-label:after {
        content: " *";
        color: red;
    }
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
    Pjax::begin([

    ]);

    $form = Activeform::begin([
        'options' => ['data' => ['pjax' => true]],
    ]);

    echo $form->field($model, 'firstName')->hint('Please, enter your name.');
    echo $form->field($model, 'password')->passwordInput()->hint('Please, enter your password.');
    echo $form->field($model, 'checkboxItems[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);
    echo $form->field($model, 'dropdownItems')->dropdownList($model->dropdownItems,
        ['prompt'=>'Select Category']
    );


    echo $form->field($model, 'radioItems')->radioList([
        1 => 'radio 1',
        2 => 'radio 2'
    ]);

    ?>
    <div class="form-group">
        <?php echo Html::submitButton("Save Info", ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end();
    Pjax::end();


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        echo "METHOD: POST";
    }
    else if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        echo "METHOD: GET";
    }
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    ?>
</div>
