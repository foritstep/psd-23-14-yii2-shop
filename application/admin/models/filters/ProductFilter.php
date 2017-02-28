<?php

namespace admin\models\filters;

use app\models\Product;

class ProductFilter extends \yii\base\Model {
    public $id;
    public $name;
    public $categoryId;
    public $price;

    public function rules() {
        return [
            ['id', 'integer'],
            ['name', 'string', 'max' => 100],
            ['categoryId', 'exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id'],
            ['price', 'double']
        ];
    }

    public function getProvider() {
        $query = Product::find()->with('category');

        $this->validate();

        if ($this->id && !$this->hasErrors('id')) {
            $query->andWhere(['id' => $this->id]);
        }

        if ($this->name && !$this->hasErrors('name')) {
            $query->andWhere(['LIKE', 'name', $this->name]);
        }

        if ($this->price && !$this->hasErrors('price')) {
            $query->andWhere(['price' => $this->price]);
        }

        if ($this->categoryId && !$this->hasErrors('categoryId')) {
            $query->andWhere(['categoryId' => $this->categoryId]);
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