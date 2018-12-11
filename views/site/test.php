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

    throw new Exception('user defined exception thrown');

    //set_error_handler('customError');

    function customExceptionHandler(Exception $e)
    {
        echo $e->getMessage();
    }

    function customErrorHandler($errLevel, $errMessage)
    {
        $message =  '[' .date("d/m/Y H:i:s") . ']' . " - ERROR: "  . "[$errLevel] $errMessage" .  PHP_EOL;
        echo $message;
        echo "<br>";
        echo "Ending script";
        if(!file_exists("files/error.log"))
        {
            $errorLogfile = fopen('files/error.log', 'w');
            fclose($errorLogfile);
        }
        error_log($message, 3, "files/error.log");
        die();
    }
    echo "<pre>";
    echo "</pre>";
    ?>
</div>
