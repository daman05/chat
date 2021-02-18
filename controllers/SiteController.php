<?php

namespace app\controllers;

use app\models\Message;

class SiteController extends AppController
{
    public $defaultAction = 'contact';

    public function actionIndex()
    {
        if (isset(\Yii::$app->user->identity->isAdmin) && \Yii::$app->user->identity->isAdmin == 1) {
            $messages = Message::find()
                ->with('user')
                ->limit(50)
                ->offset(0)
                ->orderBy('id DESC')
                ->all();
        } else {
            $messages = Message::find()
                ->where(['status' => 1])
                ->with('user')
                ->limit(50)
                ->offset(0)
                ->orderBy('id DESC')
                ->all();
        }

        $messages = array_reverse($messages);

        $model = new Message();

        if ($model->load(\Yii::$app->request->post()) && !empty($model->text)) {
            if (!\Yii::$app->user->isGuest) {
                $model->user_id = \Yii::$app->user->identity->id;
                if ($model->validate() && $model->save()) {
                    return $this->refresh();
                } else {
                    \Yii::$app->session->setFlash('error', 'Произошла ошибка!');
                }
            } else {
                \Yii::$app->session->setFlash('error', '<a href="' . \yii\helpers\Url::to(['account/signup']) . '">Регистрация</a><br>Для отправки сообщиний нужно авторизоваться!<br>Если Вы уже зарегистрированы, выполните процедуру <a href="' . \yii\helpers\Url::to(['account/login']) . '">входа</a>');
                return $this->refresh();
            }
        }

        return $this->render('chat', compact('model', 'messages'));
    }

    public function actionDelMessage($id)
    {
        debug($id);
    }
}
