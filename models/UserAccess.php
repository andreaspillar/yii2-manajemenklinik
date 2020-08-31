<?php

namespace app\models;

use app\models\StaffDokter;


class UserAccess extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'tbl_user_access';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'user_access'], 'required'],
            [['password'], 'string'],
            [['user_access'], 'integer'],
            [['username'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'user_access' => 'User Access',
        ];
    }

    public function getStaff()
    {
        return $this->hasOne(StaffDokter::className(), ['id_user' => 'id_user']);
    }
    
    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null){
        // return self::findOne(['accessToken'=>$token]);
        throw new NotSupportedException();
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function getId(){
        return $this->id_user;
    }

    public function getAuthKey(){
        // return $this->authKey;
        throw new NotSupportedException();
    }

    public function validateAuthKey($authKey){
        // return $this->authKey === $authKey;
        throw new NotSupportedException();
    }

    public function validatePassword($password){
        // return password_verify($password, $this->password);
        return $this->password === $password;
    }

    public static function findRole($role){
        return self::findOne(['user_access'=>$role]);
    }

    public function getRole()
    {
        return $this->user_access;
    }
}
