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
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

/** @var $this \yii\web\View */
/** @var $user app\models\Users */
/** @var $dataProvider yii\data\ActiveDataProvider */

?>
<div id="data-orders">
    <?php
    $fullName = ($user == Users::ALL) ? $user :  "\"$user->firstName $user->lastName\"";
?>
    <div id="Orders">

            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['style' => ['margin' => '0 auto', 'white-space' => 'nowrap', 'width' => 'fit-content']],
                'layout' => '{items}{summary}{pager}'.$this->render('_controlButtons.php', ['user' => $user]),
                'caption' => 'Orders - ' . $fullName,
                'captionOptions' => ['class' => 'h2', 'style' => 'text-align: center'],
                'tableOptions' => ['class' => 'table table-bordered table-stripped table-responsive table-centered'],
                'emptyText' => 'User - ' . $fullName .' has no orders',
                'emptyTextOptions' => ['class' => 'h4', 'style' => ['text-align' => 'center']],
                'columns' => [
                    'id',
                    'number',
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
                                return Html::a('Delete', $url, ['class' => 'btn btn-danger']);
                            },
                        ],
                        'urlCreator' => function($action, $model, $key, $index, $actionColumn)
                        {
                            if($action == 'view')
                            {
                                return Url::to(['order/form', 'id' => $model->id]);
                            }
                            else
                                return Url::to(['order/' . $action, 'id' => $model->id]);
                        }
                    ]
                ],
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    'hideOnSinglePage' => false
                ],
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
