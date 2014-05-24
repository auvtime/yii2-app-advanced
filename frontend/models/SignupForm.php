<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $birthday;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('auvtime', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('auvtime', 'This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['birthday','required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->birthday = $this->birthday;
            
            Yii::info("@@@@@@@birthday:".$this->birthday,'auvtime');
            Yii::info($this->array_to_json_string($user),'auvtime');
            $user->save();
            return $user;
        }

        return null;
    }
    
    public function array_to_json_string($arraydata) {
    	$output = "";
    	$output .= "{";
    	foreach($arraydata as $key=>$val){
    		if (is_array($val)) {
    			$output .= "\"".$key."\" : [{";
    			foreach($val as $subkey=>$subval){
    				$output .= "\"".$subkey."\" : \"".$subval."\",";
    			}
    			$output .= "}],";
    		} else {
    			$output .= "\"".$key."\" : \"".$val."\",";
    		}
    	}
    	$output .= "}";
    	return $output;
    }
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Model::attributeLabels()
     * @return multitype:
     * @author WangXianfeng 2014-5-11 上午9:50:31
     */
    public function attributeLabels()
    {
    	$username = \Yii::t('auvtime', 'username');
    	$email = \Yii::t('auvtime', 'email');
    	$password = \Yii::t('auvtime', 'password');
    	$birthday = \Yii::t('auvtime', 'birthday');
    	return [
			'username'=>$username,
			'email'=>$email,
			'password'=>$password,
			'birthday'=>$birthday,
    	];
    }
    
    public function verify($attribute,$params){
    	if(!$this->hasErrors()) // we only want to authenticate when no other input errors are present
    	{
    		$user = User::model()->findByAttributes(array('username'=>$this->username));
    		if($this->project->isUserInProject($user))
    		{
    			$this->addError('username','This user has already been added to the project.');
    		}else{
    			$this->project->associateUserToProject($user);
    			$this->project->associateUserToRole($this->role,$user->id);
    			$auth = Yii::app()->authManager;
    			$bizRule='return isset($params["project"]) &&$params["project"]->isUserInRole("'.$this->role.'");';
    			$auth->assign($this->role,$user->id, $bizRule);
    		}
    	}
    }
}
