<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/25/18
 * Time: 4:51 PM
 */

use app\models\Users;
use app\widgets\LinkPager2\LinkPager2;
use yii\bootstrap\Alert;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

/** @var $this \yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */
/** @var $searchModel app\models\OrdersSearch */

?>
<div id="data-orders">
    <?php
    $fullName = ($searchModel->user == Users::ALL) ? Users::ALL : $searchModel->user->firstName .' '. $searchModel->user->lastName;
?>
            <?php
            echo $gridView = GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'options' => ['style' => ['margin' => '0 auto', 'white-space' => 'nowrap', 'width' => 'fit-content']],
                'layout' => '{items}{summary}{pager}'.$this->render('_controlButtons.php', ['user' => $searchModel->user]),
                'caption' => 'Orders - ' . $fullName,
                'captionOptions' => ['class' => 'h2', 'style' => 'text-align: center'],
                'tableOptions' => ['class' => 'table table-bordered table-stripped table-responsive table-centered'],
                'emptyText' => 'User - ' . $fullName .' has no orders',
                'emptyTextOptions' => ['class' => 'h4', 'style' => ['text-align' => 'center']],
                'columns' => [
                    'id',
                    'number',
                    [
                        'class' => DataColumn::class,
                        'label' => 'User',
                        'attribute' => 'fullName',
                        'content' => function($model, $key, $index, $column)
                        {
                            return $model->user->firstName .' '. $model->user->lastName;
                        },
                        'visible' => ($searchModel->user == Users::ALL)
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{view} {delete}',
                        'contentOptions' => ['style' => ['text-align' => 'center']],
                        'buttons' => [
                            'view' => function($url, $model, $key)
                            {
                                return Html::a('Details', $url, ['class' => 'btn btn-info']);
                            },
                            'delete' => function($url, $model, $key)
                            {
                                return Html::a('Delete', $url, ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Are you sure?']]);
                            },
                        ],
                        'urlCreator' => function($action, $model, $key, $index, $actionColumn)
                        {
                            if($action == 'view')
                            {
                                return Url::to(['order/form', 'id' => $model->id]);
                            }
                            else
                                return Url::to(['order/' . $action, 'id' => $model->id, 'userId' => $model->user_id]);
                        }
                    ]
                ],
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    'hideOnSinglePage' => false
                ],
                'sorter' => [
                        'attributes' => ['id']
                ]
            ]);
    echo "<br>";
    echo "<br>";
    /*echo LinkPager2::widget(
            [
                'pagination' => $pagination,
                'firstPageLabel' => 'first',
                'lastPageLabel' => 'last',
                'maxButtonCount' => 5,
                'totalRecordsLabelPrefix' => 'Total records:'
            ]
    );*/
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
