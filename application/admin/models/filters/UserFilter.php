<?php

namespace admin\models\filters;

use app\models\User;

class UserFilter extends \yii\base\Model {
    public $id;
    public $login;
    public $password;

    public function rules() {
        return [
            ['id', 'integer'],
            ['login', 'string', 'max' => 100],
            ['password','string','max'=>100],
        ];
    }

    public function getProvider() {
        $query = User::find();

        $this->validate();

        if ($this->id && !$this->hasErrors('id')) {
            $query->andWhere(['id' => $this->id]);
        }

        if ($this->login && !$this->hasErrors('login')) {
            $query->andWhere(['LIKE', 'login', $this->login]);
        }

        if ($this->password && !$this->hasErrors('password')) {
            $query->andWhere(['password' => $this->password]);
        }


        return new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeParam' => false,
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

    }
}