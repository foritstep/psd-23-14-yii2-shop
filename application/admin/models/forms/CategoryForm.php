<?php

namespace admin\models\forms;

use app\models\Category;

class CategoryForm extends \yii\base\Model {
    public $id;
    public $name;
    public $parentId;

    public function rules() {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => 4, 'max' => 100],
            ['parentId', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],

            ['name', 'unique', 'targetClass' => Category::className(), 'targetAttribute' => ['name', 'parentId'], 'on' => 'add'],

            ['id', 'required', 'on' => 'edit'],
            ['name', 'customNameValidator', 'on' => 'edit']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'parentId' => 'Parent category'
        ];
    }

    public function run() {
        if ($this->validate()) {
            if ($this->id) {
                if ($category = Category::findOne($this->id)) {
                    \Yii::configure($category, [
                        'name' => $this->name,
                        'parentId' => $this->parentId
                    ]);

                    return $category->save();
                }
            } else {
                $category = new Category([
                    'name' => $this->name,
                    'parentId' => $this->parentId
                ]);

                return $category->save();
            }
        }

        return false;
    }

    public function customNameValidator() {
        if (!$this->hasErrors('name')) {
            if (Category::find()->where(['name' => $this->name,'parentId' => $this->parentId])->andWhere(['!=', 'id', $this->id])->exists()) {
                $this->addError('name', 'This name olready taken.');
            }
        }
    }
}