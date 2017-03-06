<?php

namespace site\controllers;

use app\models\Product;
use app\models\Category;

class CatalogController extends \app\base\Controller {
    public function actionCategory($id)
    {
        $products = Product::find()->orderBy(['updatedAt' => SORT_DESC])->where(['categoryId' => $id])->limit(12)->all();
        
        return $this->render('/category',['products' => $products]);
    }

    public function  actionProducts()
    {
        $products = Product::find()->orderBy(['updatedAt' => SORT_DESC])->limit(12)->all();

        return $this->render('/products', ['products' => $products]);
    }

    public function actionProduct($id)
    {
        $product = Product::findOne($id);

        return $this->render('/product',['product' => $product]);
    }
}
