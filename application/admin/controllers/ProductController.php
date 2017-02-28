<?php

namespace admin\controllers;

use app\models\Product;
use admin\models\forms\ProductForm;
use admin\models\filters\ProductFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ProductController extends \yii\web\Controller {
    public function actionIndex() {
        $model = new ProductFilter();
        $model->load(\Yii::$app->request->get());

        return $this->render('list', [
            'filterModel' => $model,
            'dataProvider' => $model->provider,
            'categories' => ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name')
        ]);
    }

    public function actionCreate() {
        $model = new ProductForm([
            'scenario' => 'add'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->images = UploadedFile::getInstances($model, 'images');

            if ($model->run()) {
                return $this->redirect(['product/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'categories' => ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name')
        ]);
    }

    public function actionUpdate($id) {
        $model = new ProductForm([
            'scenario' => 'edit',
        ]);

        if ($product = Product::findOne($id)) {
            $model->id = $product->id;
            $model->name = $product->name;
            $model->categoryId = $product->categoryId;
            $model->price = $product->price;
            $model->description = $product->description;

            if ($product->image) {
                $model->image = $product->getImageUrl([200, 200]);
            }
        }

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->run()) {
                $this->redirect(['product/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'categories' => ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name')
        ]);
    }

    public function actionDelete($id) {
        Product::deleteAll(['id' => $id]);

        return $this->redirect(['product/index']);
    }
}