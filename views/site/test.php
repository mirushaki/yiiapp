<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    table {
        collapse: collapse;
        text-align: center;
    }
    thead {
        background-color: #333333;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #9d9d9d;
    }
    td
    {
        border: 1px solid black;
        padding: 5px;
    }

</style>


<div class="site-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo "welcome";
    echo "<br>";
    $hello = \Yii::t('app', "welcome");
    echo $hello;
    echo "<br>";

    echo "<pre>";
    print_r(Yii::$classMap);
    echo "</pre>";
    ?>
    <div id="Usefull">
        <?php echo "usefull stuff here" ?>
    </div>
</div>
