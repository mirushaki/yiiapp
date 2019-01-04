<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 1/4/19
 * Time: 11:46 AM
 */

namespace app\models;

use yii\db\Exception;

class MailTemplate
{
    private $name;
    private $cssFileName;
    private $cssFileContent;

    const TEMPLATE_NEW_YEAR = 'new year';
    const TEMPLATE_WINTER = 'winter';

    public function __construct($name)
    {
        $this->name = $name;
        $this->registerCssFile();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCssFileName()
    {
        return $this->cssFileName;
    }

    public function getCssFileContent()
    {
        return $this->cssFileContent;
    }

    private function registerCssFile()
    {
        if($this->name == self::TEMPLATE_NEW_YEAR)
        {
            $this->cssFileName = 'css/mail-templates/new-year/template.css';
            $this->cssFileContent = file_get_contents($this->cssFileName);

            /*$this->cssFileName = '@web/css/mail-templates/new-year/template.css';*/
        }
        else if($this->name == self::TEMPLATE_WINTER)
        {
            $this->cssFileName = 'css/mail-templates/winter/template.css';
            $this->cssFileContent = file_get_contents($this->cssFileName);
        }
        else {
            throw new Exception('template name not found');
        }
    }
/*
    public static function getAllTemplates()
    {
        return [
           new static('new year', 'app\assets\mailAssets\MailTemplateNewYearAsset'),
           new static('winter', 'app\assets\mailAssets\MailTemplateWinterAsset')
        ];
    }*/

    public static function getAllTemplatesAsAssocArray()
    {
        return [
            self::TEMPLATE_NEW_YEAR => self::TEMPLATE_NEW_YEAR,
            self::TEMPLATE_WINTER => self::TEMPLATE_WINTER
        ];
    }
}