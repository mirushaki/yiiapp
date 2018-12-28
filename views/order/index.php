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
                'layout' => '{items}{summary}{pager}',
                'tableOptions' => ['class' => 'table table-bordered table-stripped table-responsive table-fit'],
                'caption' => 'Orders - ' . $fullName,
                'captionOptions' => ['class' => 'h2', 'style' => 'text-align: center'],
                'emptyText' => 'User - ' . $fullName .' has no orders',
                'emptyTextOptions' => ['class' => 'h4', 'style' => ['text-align' => 'center']],
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                ],
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
                ]
            ])

            /*echo "<h1>Orders - $fullName</h1>" */?><!--

            <table class="table table-responsive table-bordered table-hover table-striped table-fit">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Number</td>
                    <td>Details</td>
                    <td>Delete</td>
                </tr>
                </thead>
                <tbody>
                <?php
/*                foreach($orders as $order) {
                    $userId = $order->user_id;
                    echo "<tr>";
                    foreach ($order as $key => $value) {
                        if($key != 'user_id')
                            echo "<td>" . $value . "</td>";
                    }
                    echo '<td>';
                    echo Html::a('details', ['order/form', 'id' => $order->id], ['class' => 'btn btn-info']);
                    echo '</td>';
                    echo '<td>';
                    echo Html::a('delete', ['order/delete', 'id' => $order->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                    'confirm' => 'Are you sure?'
                            ]
                    ]);
                    echo '</td>';
                    echo "</tr>";
                }
                */?>
                </tbody>
            </table>
        </div>
    --><?php
    echo Html::a('Add new order', ['order/add', 'userId' => ($user == Users::ALL) ? '' : $user->id], ['class' => 'btn btn-primary']);
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
