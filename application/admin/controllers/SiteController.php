<?php

namespace admin\controllers;

use yii;
use admin\models\forms\LoginForm;

class SiteController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if (\Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->run()) {
                return $this->goBack();
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
