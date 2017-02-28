<?php

namespace app\models;

use app\models\Product;
use yii\imagine\Image;

class ProductImage extends  \app\base\ActiveRecord {
    public static $imageSizes = [
        [50, 50],
        [100, 100],
        [200, 200],
    ];

    public static function tableName() {
        return 'image';
    }

    public function rules() {
        return [
            [['filename', 'productId'], 'required'],
            ['filename', 'string', 'max' => 16, 'min' => 16],
            ['productId', 'exist', 'targetClass' => Product::className(), 'targetAttribute' => 'id'],
            [['createdAt', 'updatedAt'], 'safe']
        ];
    }

    public static function uploadImages($uploadedImages, $productId) {
        $productImages = [];

        foreach ($uploadedImages as $uploadedImage) {
            $filename = \Yii::$app->security->generateRandomString(16);
            $imagesPath = \Yii::getAlias('@webroot/images/products/');

            $uploadedImage->saveAs("{$imagesPath}{$filename}.tmp");

            $imagine = Image::getImagine();
            $image = $imagine->open("{$imagesPath}{$filename}.tmp");
            $image->save("{$imagesPath}{$filename}.png");

            foreach (self::$imageSizes as $size) {
                $thumb = Image::thumbnail($image, $size[0], $size[1]);
                $thumb->save("{$imagesPath}{$filename}_{$size[0]}_{$size[1]}.png");
            }

            unlink("{$imagesPath}{$filename}.tmp");

            $productImage = new self([
                'productId' => $productId,
                'filename' => $filename
            ]);

            $productImage->save();

            $productImages[] = $productImage;
        }

        return $productImages;
    }
}