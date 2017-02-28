<?php

namespace admin\models\forms;

use app\models\Product;
use app\models\ProductImage;

class ProductForm extends \yii\base\Model {
    public $id;
    public $name;
    public $categoryId;
    public $price;
    public $description;
    public $image;
    public $images;

    public function rules() {
        return [
            ['id', 'integer'],
            [['name', 'categoryId', 'price'], 'required'],
            ['price', 'double'],
            ['description', 'safe'],
            ['categoryId', 'exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id'],
            ['image', 'image', 'mimeTypes' => 'image/png, image/jpg, image/jpeg', 'maxSize' => 10050000, 'maxFiles' => 1],
            ['images', 'image', 'mimeTypes' => 'image/png, image/jpg, image/jpeg', 'maxSize' => 100500000, 'maxFiles' => 10],

            ['name', 'unique', 'targetClass' => Product::className(), 'targetAttribute' => ['name', 'categoryId'], 'on' => 'add'],

            ['id', 'required', 'on' => 'edit'],
            ['id', 'exist', 'targetClass' => Product::className()],
            ['name', 'customNameValidator', 'on' => 'edit']
        ];
    }

    public function customNameValidator() {
        if (!$this->hasErrors('name')) {
            if (Product::find()->where(['name' => $this->name, 'categoryId' => $this->categoryId])->andWhere(['!=', 'id', $this->id])->exists()) {
                $this->addError('name', 'This name olready taken.');
            }
        }
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'categoryId' => 'Category',
            'price' => 'Price',
            'description' => 'Description'
        ];
    }

    public function run() {
        if ($this->validate()) {
            switch ($this->scenario) {
                case 'add' :
                    $product = new Product();
                    $product->name = $this->name;
                    $product->categoryId = $this->categoryId;
                    $product->price = $this->price;
                    $product->description = $this->description;

                    if ($this->image) {
                        $product->uploadImage($this->image);
                    }

                    if ($product->save()) {
                        if ($this->images) {
                            ProductImage::uploadImages($this->images, $product->id);
                        }

                        return true;
                    }
                case 'edit' :
                    $product = Product::findOne($this->id);
                    $product->name = $this->name;
                    $product->categoryId = $this->categoryId;
                    $product->price = $this->price;
                    $product->description = $this->description;

                    if ($this->image) {
                        $product->uploadImage($this->image);
                    }

                    if ($this->images) {
                        ProductImage::uploadImages($this->images, $product->id);
                    }
                    
                    return $product->save();
            }
        }

        return false;
    }
}