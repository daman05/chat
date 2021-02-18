<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use yii\widgets\ActiveForm;

class AccountController extends AppController
{
    public function actionSignup()
    {
        $model = new SignupForm();

        // if (!\Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        if (\Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->signup()) {
                    \Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались!');
                    return $this->redirect('login');
                } else {
                    \Yii::$app->session->setFlash('error', 'Произошла ошибка при регистрации!');
                }
            }
        }

        \Yii::$app->view->title = 'Регистрация';
        return $this->render('signup', compact('model'));
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (\Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        \Yii::$app->view->title = 'Вход';
        $model->password = '';
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}
