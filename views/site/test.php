<?php
/* @var $this yii\web\View */
/* @var $model app\models\TestModel */
/* @var $data [] */

use app\assets\CustomAsset;
use app\widgets\MethodInfo\MethodInfo;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\Url;

use yii\jui;

CustomAsset::register($this);

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-test">
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Miro</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Dato</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Vato</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Kato</td>
            </tr>
        </tbody>
    </table>

    <a href="<?php echo Url::to(['site/calculator'])?>">Calculator</a>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if(Yii::$app->session->hasFlash('message'))
    {
        echo Alert::Widget([
            'options' => ['class' => 'alert-info'],
            'body' => Yii::$app->session->getFlash('message')
            ]
        );
    }

    echo jui\DatePicker::widget([
            'dateFormat' => 'php: m/d/Y',
            'language' => 'ka-GE'
    ]);

    echo MethodInfo::widget();
    $form = Activeform::begin();

    echo $form->field($model, 'firstName');
    echo $form->field($model, 'lastName');
    echo $form->field($model, 'password')->input('password');
    echo $form->field($model, 'extraInfo');

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
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    ?>
</div>
