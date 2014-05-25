<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
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

    /**
     * @inheritdoc
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	$nameLabel = \Yii::t('contact', 'name');
    	$emailLabel = \Yii::t('contact', 'email');
    	$subjectLabel = \Yii::t('contact', 'subject');
    	$bodyLabel = \Yii::t('contact', 'body');
    	$verifyCodeLabel = \Yii::t('contact', 'Verification Code');
        return [
        	'name' => $nameLabel,
        	'email' => $emailLabel,
        	'subject' => $subjectLabel,
        	'body' => $bodyLabel,
            'verifyCode' => $verifyCodeLabel,
        ];
    }
	
	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 *
	 * @param string $email
	 *        	the target email address
	 * @return boolean whether the email was sent
	 */
	public function sendEmail($email) {
		$mailSubject = $this->name . '[' . $this->email . ']' . $this->subject;
		return Yii::$app->mail->compose ( 'contactUs', [ 
				'mailbody' => Html::encode ( $this->body ),
				'userName' => $this->name,
				'userMail' => $this->email 
		] )->setTo ( $email )->setFrom ( $email )->setSubject ( $mailSubject )->send ();
	}
}
