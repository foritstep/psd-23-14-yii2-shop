<?php

namespace admin\controllers;

use app\models\Category;
use admin\models\forms\CategoryForm;
use admin\models\filters\CategoryFilter;
use yii\helpers\ArrayHelper;

class CategoryController extends \yii\web\Controller {
    public function actionIndex() {
        $categoryFilter = new CategoryFilter();
        $categoryFilter->load(\Yii::$app->request->get());
        
        return $this->render('list', [
            'dataProvider' => $categoryFilter->provider,
            'filterModel' => $categoryFilter,
            'categories' => ArrayHelper::map(Category::getCategoriesTreeList(), 'id', 'name')
        ]);
    }

    public function actionAdd() {
        $model = new CategoryForm([
            'scenario' => 'add'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                return $this->redirect(['category/index']);
            }
        }

        return $this->render('add', [
            'model' => $model,
            'categories' => ArrayHelper::map(Category::find()->all(), 'id', 'name')
        ]);
    }

    public function actionUpdate($id) {
        $category = Category::findOne($id);

        $model = $category
            ? new CategoryForm([
                'scenario' => 'edit',
                'id' => $category->id,
                'name' => $category->name,
                'parentId' => $category->parentId
            ])
            : new CategoryForm();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                return $this->redirect(['category/index']);
            }
        }

        return $this->render('edit', [
            'model' => $model,
            'categories' => ArrayHelper::map(Category::find()->where(['!=', 'id', $id])->all(), 'id', 'name')
        ]);
    }

    public function actionDelete($id) {
        Category::deleteAll(['id' => $id]);

        return $this->redirect(['category/index']);
    }
}