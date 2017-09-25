<?php

namespace backend\modules\user\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $audit
 * @property string $intro
 * @property string $avatar
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at' ,'audit'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email','avatar' ], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['intro'],'string'],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'info' => Yii::t('app', 'Info'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    public function addUser()
    {
        $this->created_at = time();
        $this->updated_at = time();
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $this->auth_key = Yii::$app->security->generateRandomString();
        if ($this->validate()) {
            return $this->save()?true:$this->errors;
        } else {
            return false;
        }
    }
}
