<?php


namespace site\models;

use app\models\User;

class Login extends \yii\base\Model
{
    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    public function run() {
        if ($this->validate()) {
            $user = User::findOne(['login' => $this->login]);

            if (\Yii::$app->security->validatePassword($this->password,$user->password)) {
                return \Yii::$app->user->login($user);
            };
        }

        return false;
    }

}