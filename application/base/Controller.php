<?php

namespace app\base;

use app\models\Category;

class Controller extends \yii\web\Controller {
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $categories = Category::find()->all();

            $this->view->params['categories'] = $categories;

            return true;
        }

        return false;
    }
}
