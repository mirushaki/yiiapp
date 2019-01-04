<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/4/19
 * Time: 11:29 AM
 */
/** @var $content string */
/** @var $template \app\models\MailTemplate*/

/*call_user_func([$template->getCssFileName(), 'register'], $this);*/

/*
$r = new ReflectionClass($template->assetClass);
$instance = $r->newInstanceWithoutConstructor();
$instance->register($this);*/


$title = strtok($content, "\n");
if(strlen($title)) {
    do{
        $content = strtok("\n");
    }while(empty($content));
}/*
$this->registerCssFile($template->getCssFileName());
$cssContent = file_get_contents($template->getCssFileName());*/
$this->registerCss('.mail-header-image {
    background-image: -webkit-linear-gradient(red, green, blue);
    width: 100%;
    height: 100px;
}

.mail-html {
    font-size: 14px;
    color: forestgreen;
}

.mail-html .title {
    font-size: 20px;
    color: red;
    text-align: center;
}

.mail-footer-image {
    background-image: -webkit-repeating-linear-gradient(left, red 10%, blue 30%);
    width: 100%;
    height: 50px;
}');
?>
<div class="mail-body">
    <div class="mail-header-image"></div>
    <div class="mail-html">
        <div class="title"><?php echo $title ?></div>
        <div class="content"><?php echo $content ?></div>
    </div>
    <br >
    <div class="mail-footer-image"></div>
</div>

