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
        //$products = Product::find()->orderBy(['updatedAt' => SORT_DESC])->limit(12)->where(['LIKE', 'name', $search_text])->all();

        return $this->render('/products', ['products' => $products]);
    }

    public function actionSearch($search_text)
    {
        $products = Product::find()->orderBy(['updatedAt' => SORT_DESC])->limit(12)->where(['LIKE', 'name', $search_text])->all();

        return $this->render('/search', ['products' => $products, 'search_text' => $search_text]);
    }

    public function actionProduct($id)
    {
        $product = Product::findOne($id);

        return $this->render('/product',['product' => $product]);
    }
}
