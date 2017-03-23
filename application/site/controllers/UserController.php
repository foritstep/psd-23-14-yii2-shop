<?php

namespace site\controllers;

use app\models\User;
use site\models\Registration;
use site\models\Login;

class UserController extends \app\base\Controller {
    // route = site/user/registration
    public function actionRegistration() {
        $model = new Registration();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                \Yii::$app->mailer->compose("testmail.php",['data'=>null])
                    ->setTo("test@test.com")
                    ->setFrom("siamondrewards@gmail.com")
                    ->setSubject("Test")
                    ->send();
                return $this->goHome();
            }
        }

        return $this->render('/registration', [
            'model' => $model
            
            
        ]);
    }

    public function actionLogin() {
        $model = new Login();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->run()) {
                return $this->goHome();
            }
        }

        return $this->render('/login', [
            'model' => $model


        ]);

    }

    public function actionLogout() {

  \Yii::$app->user->logout();

        return $this->goHome();

    }
}