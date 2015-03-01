<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', \Yii::t('auvtime', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
	/**
	 * (non-PHPdoc)
	 * 
	 * @see \yii\base\Model::attributeLabels()
	 * @return multitype:string Ambigous <string, string, boolean>
	 * @author WangXianfeng 2014-5-12 下午9:46:41
	 */
	public function attributeLabels() {
		$username = \Yii::t ( 'auvtime', 'Username' );
		$password = \Yii::t ( 'auvtime', 'Password' );
		$rememberme = \Yii::t('auvtime', 'Remember Me');
		return [ 
				'username' => $username,
				'password' => $password,
				'rememberMe' => $rememberme,
		];
	}
}
