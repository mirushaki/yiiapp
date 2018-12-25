<?php
/** @var $this yii\web\View */
/** @var $users app\models\Users[]*/

use yii\bootstrap\Alert;
use yii\helpers\Html;

//\app\assets\CustomAsset::register($this);

\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

$this->title = 'DATA';

?>
<div class="user-index">
    <div id="Users">
        <h1>Users</h1>
    <table class="table table-responsive table-bordered table-hover table-striped table-fit">
        <thead>
            <tr>
                <td>Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>E-mail</td>
                <td>Details</td>
                <td>Orders</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($users as $user)
                {
                    echo "<tr>";
                    foreach($user as $key=>$value)
                        echo "<td>" . $value ."</td>";
                    echo "<td>";
                    echo Html::a('details', ['user/form', 'id' => $user->id], ['class' => 'btn btn-info']);
                    echo "</td>";
                    echo "<td>";
                    echo Html::a('orders', ['order/index', 'userId' => $user->id], ['class' => 'btn btn-warning']);
                    echo "</td>";
                    echo "<td>";
                    echo Html::a('delete', ['user/delete', 'id' => $user->id],
                        ['class' => 'btn btn-danger',
                         'data' => [
                                 'confirm' => 'Are you sure?'
                         ]
                        ]);
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    </div>
    <br >
    <?php
    echo Html::a('Add user', ['user/add'], ['class' => 'btn btn-primary']);
    echo Html::a('Show all orders', ['order/index'], ['class' => 'btn btn-secondary']);
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
