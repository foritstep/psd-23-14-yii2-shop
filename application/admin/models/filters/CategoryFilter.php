<?php

namespace admin\models\filters;

use app\models\Category;

class CategoryFilter extends \yii\base\Model {
    public $id;
    public $name;
    public $parentId;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['name'], 'string', 'max' => 100],
            ['parentId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id']
        ];
    }

    public function getProvider() {
        $query = Category::find()->with('parent')->with('childs');

        $this->validate();

        if ($this->id && !$this->hasErrors('id')) {
            $query->andWhere(['id' => $this->id]);
        }

        if ($this->name && !$this->hasErrors('name')) {
            $query->andWhere(['LIKE', 'name', $this->name]);
        }

        if ($this->parentId && !$this->hasErrors('parentId')) {
            $query->andWhere(['parentId' => $this->parentId]);
        } else {
            $query->andWhere(['parentId' => null]);
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