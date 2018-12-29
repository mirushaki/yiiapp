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
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => ['margin' => '0 auto', 'white-space' => 'nowrap', 'width' => 'fit-content']],
        'layout' => '{items}{summary}{pager}'.$this->render('_controlButtons.php'),
        'tableOptions' => ['class' => 'table table-bordered table-striped table-responsive table-centered'],
        'caption' => 'Users',
        'captionOptions' => ['class' => 'h2', 'style' => ['text-align' => 'center']],
        'emptyText' => 'no users found',
        'emptyTextOptions' => ['class' => 'h4', 'style' => ['text-align' => 'center']],
        'columns' => [
                'id',
                'firstName',
                'lastName',
                'eMail',
                [
                    'class' => ActionColumn::class,
                    'template' => '{view} {delete} {orders}',
                    'contentOptions' => ['style' => ['text-align' => 'center']],
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
            ],
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'hideOnSinglePage' => false
        ]
        ]);
    echo "<br>";
    echo "<br>";
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
