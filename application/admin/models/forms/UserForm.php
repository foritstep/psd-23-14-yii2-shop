<?php

namespace admin\models\forms;

use app\models\User;

class UserForm extends \yii\base\Model
{
    public $id;
    public $login;
    public $password;

    public function rules() {
        return [
            ['id', 'integer'],
            [['login', 'password'], 'required'],

            ['login', 'unique', 'targetClass' => User::className(), 'targetAttribute' => ['login'], 'on' => 'add'],

            ['id', 'required', 'on' => 'edit'],
            ['id', 'exist', 'targetClass' => User::className()],
            ['login', 'customLoginValidator', 'on' => 'edit']
        ];
    }
    public function customLoginValidator() {
        if (!$this->hasErrors('login')) {
            if (User::find()->where(['login' => $this->login])->andWhere(['!=', 'id', $this->id])->exists()) {
                $this->addError('login', 'This login is already taken.');
            }
        }
    }

    public function attributeLabels() {
        return [
            'login' => 'Login',
            'password' => 'Password',
          ];
    }

    public function run() {
        if ($this->validate()) {
            if ($this->scenario == 'edit') {
                $user = User::findOne($this->id);
                $user->login = $this->login;
                $user->password = \Yii::$app->security->generatePasswordHash($this->password);
                return $user->save();
            } else {
                $user = new User();
                $user->login = $this->login;
                $user->password = \Yii::$app->security->generatePasswordHash($this->password);
                return $user->save();
            }
        }

        return false;
    }

}
