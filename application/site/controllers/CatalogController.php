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
}