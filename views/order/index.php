<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/25/18
 * Time: 4:51 PM
 */

use yii\bootstrap\Alert;
use yii\helpers\Html;
\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

/** @var $orders app\models\Orders[] */

?>
<div id="data-orders">
    <?php

    if(empty($orders))
    {
        echo "<h2>User has no orders</h2>";
        $userId = null;
    }
    else
    {
        ?>
        <div id="Orders">
            <h1>Orders</h1>
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
                foreach($orders as $order) {
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
                ?>
                </tbody>
            </table>
        </div>
    <?php }
    echo Html::a('Add new order', ['order/add', 'userId' => $userId], ['class' => 'btn btn-primary']);
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
