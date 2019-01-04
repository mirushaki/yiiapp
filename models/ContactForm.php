<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    public $template;

    /*public $templateAssocArray;*/


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['template', 'safe']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @param MailTemplate $template
     * @return bool whether the model passes validation
     */
    public function contact($email, $template)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose('render-template', ['content' => $this->body, 'template' => $template])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->send();

            return true;
        }
        return false;
    }

    //To do...
    public function applyTemplate($template)
    {

    }
}
