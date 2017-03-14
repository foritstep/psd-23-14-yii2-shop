<?php

namespace site\controllers;
Use app\models\Product;

class WhishlistController extends \app\base\Controller {
    public $whishlist;

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->whishlist = \Yii::$app->session->get('whishlist', []);
            return true;
        }

        return false;
    }

    public function afterAction($action, $result)
    {
        \Yii::$app->session->set('whishlist', $this->whishlist);
        return parent::afterAction($action, $result);
    }

    public function actionIndex() {
        $products = Product::find()->where(['id' => $this->whishlist])->all();

        return $this->render('/whishlist', ['products' => $products]);
    }

    public function actionAdd($id) {
        if (!in_array($id, $this->whishlist))
        {
            $this->whishlist[] = $id;
        }

        return $this->goBack();
    }

    public function actionDelete($id)
    {
        if(in_array($id, $this->whishlist))
        {
            unset($this->whishlist[array_search($id, $this->whishlist)]);
        }

        return $this->redirect(['index']);
    }

}