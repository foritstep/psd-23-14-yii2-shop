<?php

namespace app\base;

use app\models\Category;

class Controller extends \yii\web\Controller {
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $categories = Category::find()->all();
            $sum = 0;
            $this->view->params['categories'] = $categories;
            $cart = \Yii::$app->session->get('cart',[]);
            foreach ($cart as $quantity) {
                $sum += $quantity;
            }
            $this->view->params['cartSum'] = $sum;
            return true;
        }

        return false;
    }
    
}
