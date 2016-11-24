<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Group;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $login;
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login', 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('base', 'Логин занят')],
            ['login', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => Yii::t('base', 'Этот Email уже используется')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => Yii::t('base', 'Логин'),
            'password' => Yii::t('base', 'Пароль'),
            'email' => Yii::t('base', 'Email'),
        ];
    }
    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->login = $this->login;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->group_id = Group::GROUP_MEMBER;
        
        if ($user->save()) {
            Yii::$app->mailer->compose(
                    ['html' => 'verifyRegistration-html', 'text' => 'verifyRegistration-text'],
                    ['user' => $user]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['name'] . ' robot'])
                ->setTo($this->email)
                ->setSubject(Yii::t('base', 'Регистрация на сайте ') . Yii::$app->params['name'])
                ->send();
            return $user;
        }
        
        return null;
    }
}
