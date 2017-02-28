<?php

namespace admin\controllers;

use app\models\User;
use admin\models\forms\UserForm;
use admin\models\filters\UserFilter;
use yii\helpers\ArrayHelper;

class UserController extends \yii\web\Controller {
    public function actionIndex() {
        $model = new UserFilter();
        $model->load(\Yii::$app->request->get());

        return $this->render('list', [
            'filterModel' => $model,
            'dataProvider' => $model->provider,
        ]);
    }

    public function actionCreate() {
        $model = new UserForm([
            'scenario' => 'add'
        ]);

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                return $this->redirect(['user/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
            'user' => ArrayHelper::map(\app\models\User::find()->all(), 'id', 'login')
        ]);
    }

    public function actionUpdate($id) {
        $model = new UserForm([
            'scenario' => 'edit',
        ]);

        if ($user = User::findOne($id)) {
            $model->id = $user->id;
            $model->login = $user->login;
            $model->password = $user->password;
        }

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                $this->redirect(['user/index']);
            }
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
       User::deleteAll(['id' => $id]);


            return $this->redirect(['user/index']);
       
    }
}