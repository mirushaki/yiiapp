<?php
/** @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
/** @var $searchModel \app\models\UsersSearch */

use app\widgets\LinkPager2\LinkPager2;
use yii\bootstrap\Alert;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

//\app\assets\CustomAsset::register($this);

\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

$this->title = 'DATA';

?>
<div class="user-index">
    <br>
    <?php
    echo Html::a('Add user', ['user/add'], ['class' => 'btn btn-primary']);
    echo Html::a('Show all orders', ['order/index'], ['class' => 'btn btn-secondary']);
    echo "<br>";
    echo "<br>";
    echo GridView::widget([
        'dataProvider' => $dataProvider,/*
        'caption' => 'Users',
        'captionOptions' => ['class' => 'h1', 'style' => ['text-align' => 'center']],*/
        'filterModel' => $searchModel,
        'columns' => [
                'id',
                'firstName',
                'lastName',
                'eMail',
                [
                    'class' => ActionColumn::class,
                    'template' => '{view} {delete} {orders}',
                    'buttons' => [
                            'view' => function($url, $model, $key) {
                                return Html::a('Details', $url, ['class' => 'btn btn-info']);
                            },
                            'delete' => function($url, $model, $key) {
                                return Html::a('Delete', $url, ['class' => 'btn btn-danger', 'data' => [
                                    'confirm' => 'Are you sure?'
                                ]]);
                            },
                            'orders' => function($url, $model, $key) {
                                return Html::a('Orders', $url, ['class' => 'btn btn-warning']);
                            }
                    ],
                    'urlCreator' => function ($action, $model, $key, $index, $actionCol) {
                        if($action == 'view') {
                            return Url::to(['user/form', 'id' => $model->id]);
                        }
                        else if($action == 'orders') {
                            return Url::to(['order/index', 'userId' => $model->id]);
                        }
                        else {
                            return Url::to(['user/'.$action, 'id' => $model->id]);
                        }
                    }
                ]
            ]
        ]);

    if(Yii::$app->session->hasFlash('message'))
    {
        echo Alert::widget([
            'options' => ['class' => Yii::$app->session->hasFlash('message-class') ?
                Yii::$app->session->getFlash('message-class') : 'alert-info'],
            'body' => Yii::$app->session->getFlash('message')
        ]);
    }
    ?>
</div>
