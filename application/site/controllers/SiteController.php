<?php

namespace site\controllers;

use app\models\Category;
use app\models\Product;
class SiteController extends \app\base\Controller {
    public function actionIndex() {
        
        $products = Product::find()->orderBy(['updatedAt' => SORT_DESC])->limit(6)->all();

        return $this->render('/index', ['products' => $products]);
    }
}