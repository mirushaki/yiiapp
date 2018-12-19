<?php
/** @var $this yii\web\View */
/** @var $users */

use yii\helpers\Html;

\app\assets\CustomAsset::register($this);

$this->title = 'DATA';

?>
<div class="data-index">
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>E-mail</td>
                <td>Details</td>
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
                    echo Html::a('details', ['data/user-form', 'id' => $user['Id']]);
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <br >
    <?php
    echo Html::a('Add User', ['data/add-user'], ['class' => 'btn btn-primary']);
    ?>
</div>


