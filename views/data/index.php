<?php
/** @var $this yii\web\View */
/** @var $users */

use yii\bootstrap\Alert;
use yii\helpers\Html;

\app\assets\CustomAsset::register($this);

\app\assets\BootBoxAsset::register($this);
\app\assets\BootBoxAsset::overrideSystemConfirm();

$this->title = 'DATA';

?>
<div class="data-index">
    <div id="Users">
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>E-mail</td>
                <td>Details</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($users as $user)
                {
                    echo "<tr>";
                    $userId = 0;
                    foreach($user as $key=>$value)
                        echo "<td>" . $value ."</td>";
                    echo "<td>";
                    echo Html::a('details', ['data/user-form', 'id' => $user->id], ['class' => 'btn btn-info']);
                    echo "</td>";
                    echo "<td>";
                    echo Html::a('delete', ['data/delete-user', 'id' => $user->id],
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
    <div id="Orders">
        <table>
            <thead>
            <tr>
                <td>Id</td>
                <td>Number</td>
                <td>User Id</td>
                <td>Details</td>
                <td>Delete</td>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($users-> as $user)
            {
                echo "<tr>";
                $userId = 0;
                foreach($user as $key=>$value)
                    echo "<td>" . $value ."</td>";
                echo "<td>";
                echo Html::a('details', ['data/user-form', 'id' => $user->id], ['class' => 'btn btn-info']);
                echo "</td>";
                echo "<td>";
                echo Html::a('delete', ['data/delete-user', 'id' => $user->id],
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
    echo Html::a('Add User', ['data/add-user'], ['class' => 'btn btn-primary']);
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


