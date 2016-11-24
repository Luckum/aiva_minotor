<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Group;
use app\models\BaseModel;

/**
 * User model
 *
 * @property integer $id
 * @property string $login
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $creation_date
 * @property integer $group_id
 * @property string  $verify_code
 * @property string $name
 * @property string $password write-only password
 */
class User extends BaseModel implements IdentityInterface
{
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    
    public $new_password;
    public $new_password_2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            //TimestampBehavior::className(),
        ];
    }
    
    /*public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email', 'name'], 'trim'],
            [['login', 'email', 'password', 'group_id'], 'required'],
            ['login', 'unique', 'message' => Yii::t('base', 'Логин занят')],
            ['email', 'unique', 'message' => Yii::t('base', 'Этот Email уже используется')],
            [['login', 'name'], 'string', 'min' => 2, 'max' => 255],
            ['email', 'string', 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE, self::STATUS_ACTIVE, self::STATUS_SUSPENDED]],
            ['verify_code', 'safe', 'except' => ['admin_create', 'admin_update']],
            [['new_password', 'new_password_2'], 'required', 'on' => ['changePass']],
            ['new_password_2', 'compare', 'compareAttribute' => 'new_password', 'on' => ['changePass']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base', 'ID'),
            'login' => Yii::t('base', 'Логин'),
            'email' => Yii::t('base', 'Email'),
            'name' => Yii::t('base', 'Имя'),
            'creation_date' => Yii::t('base', 'Дата регистрации'),
            'group_id' => Yii::t('base', 'Группа'),
            'status' => Yii::t('base', 'Статус'),
            'password' => Yii::t('base', 'Пароль'),
            'new_password' => Yii::t('base', 'Новый пароль'),
            'new_password_2' => Yii::t('base', 'Подтверждение нового пароля'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function getPassword()
    {
        $user = $this->findOne($this->id);
        return $user->password;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    public function isAdmin()
    {
        if (Yii::$app->user->identity->group_id == Group::GROUP_ADMIN) {
            return true;
        } else {
            return false;
        }
    }
    
    public function activate($verifyCode)
    {
        if ($user = $this->findOne(['verify_code' => $verifyCode])) {
            $user->verify_code = NULL;
            $user->status = self::STATUS_ACTIVE;
            return $user->save();
        }
        return false;
    }
    
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
    
    public function getGroupName()
    {
        $group = $this->group;
        return $group ? $group->name : '';
    }
    
    public function beforeValidate()
    {
        if ($this->scenario == 'changePass') {
            if (Yii::$app->security->validatePassword($this->password, $this->getPassword())) {
                $this->setPassword($this->new_password);
            }
        }
        
        if ($this->isNewRecord) {
            $this->setPassword($this->password);
            $this->generateAuthKey();
            if ($this->scenario != 'admin_create') {
                $this->verify_code = substr(md5(time()),0,8);
            }
        }
        
        return parent::beforeValidate();
    }
}
