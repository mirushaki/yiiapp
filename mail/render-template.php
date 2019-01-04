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

$this->registerCss($template->getCssFileContent());

$title = strtok($content, "\n");
if(strlen($title)) {
    do{
        $content = strtok("\n");
    }while(empty($content));
}
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

