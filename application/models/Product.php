<?php

namespace app\models;

use yii\imagine\Image;
use app\models\ProductImage;

class Product extends \app\base\ActiveRecord {
    public static $imageSizes = [
        [50, 50],
        [100, 100],
        [200, 200],
    ];

    public static function tableName()
    {
        return 'product';
    }

    public function rules() {
        return [
            [['name', 'categoryId', 'price'], 'required'],
            ['image', 'string', 'max' => 16, 'min' => 16],
            ['description', 'safe'],
            [['createdAt', 'updatedAt'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'categoryId' => 'Category',
            'cratedAt' => 'Date created',
            'updatedAt' => 'Date updated'
        ];
    }

    public function getCategory() {
        return $this->hasOne('app\models\Category', ['id' => 'categoryId']);
    }

    public function getImageUrl($size = null) {
        $size = $size ? "_{$size[0]}_{$size[1]}" : '';

        if ($this->image) {
            return \Yii::getAlias("@web/images/products/{$this->image}{$size}.png");
        }

        return \Yii::getAlias("@web/images/products/default{$size}.png");
    }

    public function uploadImage($uploadedImage) {
        $this->image = $this->image ?: \Yii::$app->security->generateRandomString(16);
        $imagesPath = \Yii::getAlias('@webroot/images/products/');

        $uploadedImage->saveAs("{$imagesPath}{$this->image}.tmp");

        $imagine = Image::getImagine();
        $image = $imagine->open("{$imagesPath}{$this->image}.tmp");
        $image->save("{$imagesPath}{$this->image}.png");

        foreach (self::$imageSizes as $size) {
            $thumb = Image::thumbnail($image, $size[0], $size[1]);
            $thumb->save("{$imagesPath}{$this->image}_{$size[0]}_{$size[1]}.png");
        }

        unlink("{$imagesPath}{$this->image}.tmp");
    }
}

/*
$product = Product::findOne(1);
var_dump($product->category);
*/